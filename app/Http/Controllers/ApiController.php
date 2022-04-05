<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryRoom;
use App\Room;
use App\Event;
use App\Reservation;
use App\DetailBill;
use Illuminate\Support\Facades\Input;

class ApiController extends Controller
{
    public function getRoomType()
    {
        $data = CategoryRoom::all();
        return response()->json([
            'code' => '200',
            'data' => $data
        ]);
    }
    public function testPost()
    {
        $name = Input::get('name');
        return $name;
    }
    public function getNews()
    {
        $data = Event::all();
        return response()->json([
            'code' => '200',
            'data' => $data
        ]);
    }
    public function getHistory(Request $request)
    {
        $historyList = [];
        if ($request->has('email')) {
            $reservation = Reservation::where('email', $request->input('email'))->get();
            $properties = [];
            foreach ($reservation as $array_item) {
                if (!is_null($array_item['id'])) {
                    $properties['id'] = $array_item['id'];
                    $properties['idRoom'] = $array_item['idRoom'];
                    $properties['DateIn'] = $array_item['DateIn'];
                    $properties['DateOut'] = $array_item['DateOut'];
                    $properties['status'] = $array_item['status'];
                    $room = Room::where('id', $properties['idRoom'])->first();
                    $properties['roomName'] = $room['name'];
                    $idCategory = $room['idCategory'];
                    $properties['categoryRoomName'] = CategoryRoom::where('id', $idCategory)->first()['name'];
                    $properties['image'] = CategoryRoom::where('id', $idCategory)->first()['image'];
                    $properties['price'] = DetailBill::where('idReservation', $properties['id'])->first()['price'];
                }
                array_push($historyList, $properties);
            }
            return response()->json([
                'code' => '200',
                'data' => $historyList
            ]);
        } else {
            $data = Reservation::all();
            return response()->json([
                'code' => '200',
                'data' => $data
            ]);
        }
    }



    public function getRoomAvailable(Request $request, $idroom)
    {
        $numberRoom = $request->input('number');
        $room = Room::where('Status', 1)->where('idCategory', $idroom)->get();
        if ($numberRoom && $numberRoom <= count($room)) {
            return response()->json([
                'code' => '200',
                'data' => $room
            ]);
        } else {
            return response()->json([
                'code' => '400',
                'message' => 'Tidak ada cukup kamar yang tersisa untuk dipesan, silakan kembali lagi nanti!'
            ]);
        }
    }

    public function getMonthReportData($idMonth)
    {
        $reservation = Reservation::all()
            ->whereMonth('DateOut', $idMonth)
            ->orderBy('DateOut', 'ASC')
            ->get();

        return response()->json([
            'code' => '200',
            'data' => $reservation
        ]);
    }

    public function postReservation()
    {
        $room_category = Input::get('room_category');

        $room = Room::where('Status', 1)->where('idCategory', $room_category)->get();
        if (count($room) > 0) {
            $roomtaken = Room::where('Status', 1)->where('idCategory', $room_category)->take(1)->get();

            $reservation = new Reservation;
            $reservation->name = Input::get('name');
            $reservation->email = Input::get('email');
            $reservation->phone = Input::get('phone');
            $reservation->DateIn = Input::get('dateIn');
            $reservation->DateOut = Input::get('dateOut');
            $reservation->Numbers = Input::get('numbers');
            $reservation->Notes = Input::get('note');
            $reservation->idRoom = $roomtaken[0]->id;
            $roomtaken[0]->Status = 0;
            $reservation->save();



            $r = Room::find($reservation->idRoom);
            $cate = CategoryRoom::find($r->idCategory);

            $day = (strtotime($reservation->DateOut) - strtotime($reservation->DateIn)) / 60 / 60 / 24;
            $bill = new DetailBill;
            $bill->content = 'Tiền phòng';
            $bill->price = $cate->price * $day;
            $bill->idReservation = $reservation->id;
            $bill->created_at = Input::get('dateOut');


            $roomtaken[0]->save();
            $bill->save();

            return response()->json([
                'code' => '200',
                'message' => 'Pemesanan berhasil. Kamar Anda adalah ' . $roomtaken[0]->name . '  .See you soon !',
                'data' => $reservation
            ]);
        } else return response()->json([
            'code' => '400',
            'message' => 'Jenis kamar yang Anda pesan sudah habis. Silakan merujuk ke jenis kamar yang tersisa di sistem hotel. Terima kasih !',
        ]);
    }
    public function Reservation(Request $request)
    {
        $numberRoom = $request->input('number');
        $room_category = Input::get('room_category');
        $room = Room::where('Status', 1)->where('idCategory', $room_category)->get();
        $roomList = [];
        if ($numberRoom && $numberRoom <= count($room)) {
            for ($i = 0; $i < $numberRoom; $i++) {
                $roomtaken = Room::where('Status', 1)->where('idCategory', $room_category)->take(1)->get();
                $reservation = new Reservation;
                $reservation->name = Input::get('name');
                $reservation->email = Input::get('email');
                $reservation->phone = Input::get('phone');
                $reservation->DateIn = Input::get('dateIn');
                $reservation->DateOut = Input::get('dateOut');
                $reservation->Numbers = Input::get('numbers');
                $reservation->Notes = Input::get('note');
                $reservation->idRoom = $roomtaken[0]->id;
                $roomtaken[0]->Status = 0;
                $reservation->save();
                $r = Room::find($reservation->idRoom);
                $cate = CategoryRoom::find($r->idCategory);
                $day = (strtotime($reservation->DateOut) - strtotime($reservation->DateIn)) / 60 / 60 / 24;
                $bill = new DetailBill;
                $bill->content = 'Tiền phòng';
                $bill->price = $cate->price * $day;
                $bill->idReservation = $reservation->id;
                $bill->created_at = Input::get('dateOut');
                $roomtaken[0]->save();
                $bill->save();
                $roomList[$i] = $roomtaken[0]->name;
            }
            return response()->json([
                'code' => '200',
                'message' => 'Successful booking.See you soon !',
                'data' => $reservation
            ]);
        } else {
            return response()->json([
                'code' => '400',
                'message' => 'Tidak ada cukup kamar yang tersisa untuk dipesan. Silakan coba lagi nanti!',
                'data' => $reservation
            ]);
        }
    }
}
