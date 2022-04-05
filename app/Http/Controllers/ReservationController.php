<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\CategoryReservation;
use App\Room;
use App\DetailBill;
use App\CategoryRoom;

class ReservationController extends Controller
{
    public function getReservation()
    {
        // $reservation=Reservation::where('status',null)->get();

        $reservation = Reservation::all();
        $room = Room::all();
        return view('admin.reservation.list', ['reservation' => $reservation, 'room' => $room]);
    }
    public function Edit($id)
    {
        $room = Room::all();
        $reservation = Reservation::find($id);
        return view('admin.reservation.edit', ['reservation' => $reservation, 'room' => $room]);
    }
    public function EditPost(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'idRoom' => 'required',
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'DateIn' => 'required',
                'DateOut' => 'required',
                'Numbers' => 'required',
            ],
            [

                'idRoom.required' => "Anda belum memasukkan nama ruangan",
                'name.required' => "Anda belum memasukkan nama pelanggan",
                'phone.required' => "Anda tidak memasukkan nomor telepon",
                'email.required' => "Anda tidak memasukkan email",
                'DateIn.required' => "Anda belum memasukkan tanggal kedatangan",
                'DateOut.required' => "Anda belum memasukkan tanggal keluar",
                'Numbers.required' => "Anda tidak memasukkan nomor",

            ]
        );

        $reservation = Reservation::find($id);
        // $reservation->link=$request->link;

        $reservation->idRoom = $request->idRoom;
        $reservation->name = $request->name;
        $reservation->phone = $request->phone;
        $reservation->email = $request->email;
        $reservation->DateIn = $request->DateIn;
        $reservation->DateOut = $request->DateOut;
        $reservation->Numbers = $request->Numbers;
        $reservation->Notes = $request->Notes;




        $reservation->save();


        return redirect('admin/reservation/list')->with('annoucement', 'Informasi reservasi berhasil diedit');
    }

    public function Add()
    {

        $room = Room::all();
        return view('admin.reservation.add', ['room' => $room]);
    }
    public function AddPost(Request $request)
    {
        $this->validate(
            $request,
            [
                'idRoom' => 'required',
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'DateIn' => 'required',
                'DateOut' => 'required',
                'Numbers' => 'required',
            ],
            [

                'idRoom.required' => "Anda belum memasukkan nama ruangan",
                'name.required' => "Anda belum memasukkan nama pelanggan",
                'phone.required' => "Anda tidak memasukkan nomor telepon",
                'email.required' => "Anda tidak memasukkan email",
                'DateIn.required' => "Anda belum memasukkan tanggal kedatangan",
                'DateOut.required' => "Anda belum memasukkan tanggal keluar",
                'Numbers.required' => "Anda tidak memasukkan nomor",

            ]
        );

        $roomtaken = Room::where('id', $request->idRoom)->get();
        $roomtaken[0]->Status = 0;
        $roomtaken[0]->save();

        $reservation = new Reservation;
        // $reservation->link=$request->link;

        $reservation->idRoom = $request->idRoom;
        $reservation->name = $request->name;
        $reservation->phone = $request->phone;
        $reservation->email = $request->email;
        $reservation->DateIn = $request->DateIn;
        $reservation->DateOut = $request->DateOut;
        $reservation->Numbers = $request->Numbers;
        $reservation->Notes = $request->Notes;

        $reservation->save();

        $r = Room::find($reservation->idRoom);
        $cate = CategoryRoom::find($r->idCategory);

        $day = (strtotime($reservation->DateOut) - strtotime($reservation->DateIn)) / 60 / 60 / 24;
        $bill = new DetailBill;
        $bill->content = 'Biaya ruangan';
        $bill->price = $cate->price * $day;
        $bill->idReservation = $reservation->id;
        $bill->save();


        return redirect('admin/reservation/list')->with('annoucement', 'Berhasil menambahkan reservasi');
    }
    public function Delete($id)
    {
        $bill = DetailBill::where('idReservation', $id)->get();
        // foreach ($bill as $b) {
        //     $b->delete();
        // }

        $reservation = Reservation::find($id);
        $room = Room::find($reservation->idRoom);
        $room->Status = 1;
        $room->save();
        $reservation->delete();
        return redirect('admin/reservation/list')->with('annoucement', 'Berhasil diperiksa');
    }
}
