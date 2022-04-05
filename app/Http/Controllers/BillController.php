<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\DetailBill;
use App\Reservation;
class BillController extends Controller
{
	public function getBill($id)
	{
		$bill=DetailBill::where('idReservation',$id)->get();
        $reservation=Reservation::find($id);

		return view('admin.bill.list',['bill'=>$bill,'reservation'=>$reservation]);
	}
	

    public function Add($id)
    {
        $reservation=Reservation::find($id);
        return view('admin.bill.add',['reservation'=>$reservation]);
    }

    public function AddPost(Request $request,$id)
    {
        $this->validate($request,
        [
            'content'=>'required',
            'price'=>'required',
           
            
        ],
        [   
            'content.required'=>"Anda tidak memasukkan konten",
            'price.required'=>"Anda belum memasukkan harga",
           
           
        ]);

        $bill=new DetailBill;
        $bill->content=$request->content;
        $bill->price=$request->price;
        $bill->idReservation=$id;
        $bill->save();
       
    
     


        return redirect('admin/bill/list/'.$id)->with('annoucement','Berhasil menambahkan tagihan');
    }
    public function Delete($id,$idReser)
    {
       
        $bill=DetailBill::find($id);
        $bill->delete();
        return redirect('admin/bill/list/'.$idReser)->with('annoucement','Hapus tagihan berhasil');
     }
     
}
