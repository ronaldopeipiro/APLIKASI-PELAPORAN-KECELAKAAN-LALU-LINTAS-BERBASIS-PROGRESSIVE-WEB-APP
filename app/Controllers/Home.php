<?php

namespace App\Controllers;

use \App\Models\PushNotifModel;
use \App\Models\LaporanModel;
use \App\Models\PelaporModel;
use \App\Models\PersonilModel;
use \App\Models\PangkatPersonilModel;
use \App\Models\SatkerPersonilModel;

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class Home extends BaseController
{
    public function __construct()
    {
        $this->PushNotifModel = new PushNotifModel();
        $this->LaporanModel = new LaporanModel();
        $this->PelaporModel = new PelaporModel();
        $this->PersonilModel = new PersonilModel();
        $this->PangkatPersonilModel = new PangkatPersonilModel();
        $this->SatkerPersonilModel = new SatkerPersonilModel();

        $this->request = \Config\Services::request();
        $this->db = \Config\Database::connect();

        // $this->keyAPI = "AIzaSyBpc-W4SSnb8kM3cNDK9MYNCucHZdS7Els";
        $this->keyAPI = "AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k";
    }

    public function get_youtube_title($ref)
    {
        $json = file_get_contents('http://www.youtube.com/embed?url=http://www.youtube.com/watch?v=' . $ref . '&format=json');
        $details = json_decode($json, true);

        //return the video title
        return $details['title'];
    }

    public function get_client_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function offline()
    {
        $data = [
            'request' => $this->request,
            'db' => $this->db,
            'title' => 'OFFLINE PAGE',
        ];
        return view('landing/offline/views', $data);
    }

    public function index()
    {
        $data = [
            'request' => $this->request,
            'db' => $this->db,
            'title' => 'LANDING PAGE',
        ];
        return view('landing/main/views', $data);
    }

    public function choose_user()
    {
        $data = [
            'request' => $this->request,
            'db' => $this->db,
            'title' => 'Masuk Sebagai',
        ];
        return view('landing/main/choose-user', $data);
    }

    public function getAddress($latitude, $longitude)
    {
        //google map api url
        $url = "https://maps.google.com/maps/api/geocode/json?latlng=$latitude,$longitude&key=$this->keyAPI";

        // send http request
        $geocode = file_get_contents($url);
        $json = json_decode($geocode);
        $address = $json->results[0]->formatted_address;
        return $address;
    }

    public function distance_matrix_google($lat1, $lng1, $lat2, $lng2)
    {
        $fetch = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?departure_time=now&destinations=$lat2%2C$lng2&origins=$lat1%2C$lng1&key=$this->keyAPI&region=ID&language=id");
        $json = json_decode($fetch);

        $data['distance'] = $json->rows[0]->elements[0]->distance->text;;
        $data['duration'] = $json->rows[0]->elements[0]->duration->text;
        $data['duration_in_traffic'] = $json->rows[0]->elements[0]->duration_in_traffic->text;

        return $data;
    }

    public function push_subscription()
    {
        $id_user = $this->request->getPost('id_user');
        $tipe_user = $this->request->getPost('tipe_user');
        $endpoint = $this->request->getPost('endpoint');
        $p256dh = $this->request->getPost('p256dh');
        $auth = $this->request->getPost('auth');

        $cek_data = $this->db->query("SELECT * FROM tb_push_notif WHERE id_user='$id_user' AND tipe_user='$tipe_user' AND endpoint = '$endpoint'");
        if ($cek_data->getNumRows() == 0) {
            $this->PushNotifModel->save([
                'id_user' => $id_user,
                'tipe_user' => $tipe_user,
                'endpoint' => $endpoint,
                'p256dh' => $p256dh,
                'auth' => $auth
            ]);
        } else {
            $data = $cek_data->getRow();
            $this->PushNotifModel->updatePushNotif([
                'p256dh' => $p256dh,
                'auth' => $auth
            ], $data->id_push_notif);
        }
    }

    public function send_push_notif()
    {
        $id_user = $this->request->getPost('id_user');
        $tipe_user = $this->request->getPost('tipe_user');
        $text_pesan = $this->request->getPost('text_pesan');
        $contentencoding = $this->request->getPost('ce');

        $auth = [
            'VAPID' => [
                'subject' => 'https://ronal.titipkite.id/',
                'publicKey' => file_get_contents(base_url() . '/notif-keys/public_key.txt'),
                'privateKey' => file_get_contents(base_url() . '/notif-keys/private_key.txt')
            ],
        ];

        if ($tipe_user == "pelapor") {
            $user = $this->PelaporModel->getPelapor($id_user);
        } elseif ($tipe_user == "personil") {
            $user = $this->PersonilModel->getPersonil($id_user);
        }

        $email_user = $user["email"];
        $confirm_send_notif = "Notif to User [$email_user] -> ";

        $cek_user = $this->db->query("SELECT * FROM tb_push_notif WHERE id_user='$id_user' AND tipe_user='$tipe_user' ORDER BY id_push_notif DESC");
        foreach ($cek_user->getResult('array') as $result) {
            $tujuan = array(
                "endpoint" => $result['endpoint'],
                "expirationTime" => "",
                "keys" => array(
                    "p256dh" => $result['p256dh'],
                    "auth" => $result['auth']
                ),
                "contentEncoding" => "$contentencoding"
            );

            $subscription = Subscription::create($tujuan, true);
            $webPush = new WebPush($auth);

            $report = $webPush->sendOneNotification(
                $subscription,
                $text_pesan
            );

            $endpoint = $report->getRequest()->getUri()->__toString();

            if ($report->isSuccess()) {
                $result_success = true;
                $confirm_send_notif .= "Sent to $endpoint -> ";
            } else {
                $result_success = false;
                $confirm_send_notif .= "Failed to $endpoint -> ";

                $this->db->query("DELETE FROM tb_push_notif WHERE endpoint='$endpoint' ");
            }
        }

        if ($confirm_send_notif != "") {
            echo json_encode(array(
                'pesan' => "$confirm_send_notif"
            ));
        }
    }

    public function getKoordinatPersonil()
    {
        $index = 0;
        $data = [];

        $data_personil = $this->db->query("SELECT * FROM tb_personil WHERE latitude != '' AND longitude != '' AND id_satker != '' AND id_pangkat != '' AND aktif = '1' ORDER BY id_personil DESC ");
        foreach ($data_personil->getResult('array') as $row) {
            $pangkat = $this->PangkatPersonilModel->getPangkatPersonil($row['id_pangkat']);
            $satker = $this->SatkerPersonilModel->getSatkerPersonil($row['id_satker']);

            $data[$index]['no'] = $index + 1;
            $data[$index]['id_personil'] = $row['id_personil'];
            $data[$index]['pangkat'] = $pangkat['singkatan'];
            $data[$index]['nama_lengkap'] = $row['nama_lengkap'];
            $data[$index]['email'] = $row['email'];
            $data[$index]['nrp'] = $row['nrp'];
            $data[$index]['satker'] = $satker['nama_satker'];
            $data[$index]['latitude'] = $row['latitude'];
            $data[$index]['longitude'] = $row['longitude'];
            $data[$index]['create_datetime'] = strftime('%d/%m/%Y %H:%M:%S', strtotime($row['create_datetime'])) . " WIB";
            $index++;
        }

        echo json_encode($data);
    }
}
