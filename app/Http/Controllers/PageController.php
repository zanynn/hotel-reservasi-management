<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Information;
use App\About;
use App\CategoryRoom;
use App\Description;
use App\Slide;
use App\CategoryFood;
use App\Review;
use App\Event;
use App\Reservation;
use App\Room;
use App\User;
use App\DetailBill;
use App\Food;
use App\Repositories\CategoryFood\CategoryFoodInterface;
use App\Builder\PageBuilder;

class PageController extends Controller
{

    function __construct(
        CategoryFoodInterface $category_food
        // Information $information, 
        // About $about,
        // Description $description,
        // Slide $slide,
        // Event $event,
        // CategoryRoom $category
    ) {
        $this->category_food = $category_food;

        $builder = new PageBuilder($this);
        $this->builder = $builder->setInfor()
            ->setAbout()
            ->setDescription()
            ->setSlide()
            ->setEvent()
            ->setCategory()
            ->setCategoryAlbk()
            ->setCategoryMad();
        $this->shareView();

        //$this->infor=$information->find(0);
        // $this->about=$about->find(1);
        // $this->description=$description->find(1);
        // $this->slide=$slide->all();
        // $this->event=$event->all();
        // $this->category=$event->all();

        // view()->share('infor', $this->infor);
        // view()->share('about', $this->about);
        // view()->share('description', $this->description);
        // view()->share('slide', $this->slide);
        // view()->share('event', $this->event);
        // view()->share('category', $this->category);
    }

    public function shareView()
    {
        view()->share('infor', $this->builder->getInfor());
        view()->share('about', $this->builder->getAbout());
        view()->share('description', $this->builder->getDescription());
        view()->share('slide', $this->builder->getSlide());
        view()->share('event', $this->builder->getEvent());
        view()->share('category', $this->builder->getCategory());
        view()->share('category_albk', $this->builder->getCategoryAlbk());
        view()->share('categoryMad', $this->builder->getCategoryMad());
    }
    // public function adduser()
    // {
    //     $user=new User;
    //     $user->name='duy';
    //      $user->password=bcrypt('123');
    //     $user->save();
    //     return redirect('admin/login')->with('annoucement','them thanh cong');
    // }
    public function Home()
    {
        $food_category = CategoryFood::all();
        $food_category = $this->category_food->GetAll();
        //return $this->builder->getInfor();
        $review = Review::all();
        // $food=new Food();
        // $food_data=$food->GetById(3);
        // var_dump($food_data);return;
        return view('pages.Home1', ['food_category' => $food_category, 'review' => $review]);
    }
    public function HomeMadidihang()
    {
        $category_mad = CategoryRoom::where('category_wisma', 1)->get();
        $food_category = CategoryFood::all();
        $food_category = $this->category_food->GetAll();
        //return $this->builder->getInfor();
        $review = Review::all();
        // $food=new Food();
        // $food_data=$food->GetById(3);
        // var_dump($food_data);return;
        return view('pages.Home_madidihang', ['food_category' => $food_category, 'review' => $review, 'category_wisma' => $category_mad]);
    }
    public function HomeAlbakor()
    {
        $food_category = CategoryFood::all();
        $food_category = $this->category_food->GetAll();
        //return $this->builder->getInfor();
        $review = Review::all();
        // $food=new Food();
        // $food_data=$food->GetById(3);
        // var_dump($food_data);return;
        return view('pages.Home_albakor', ['food_category' => $food_category, 'review' => $review]);
    }

    public function About()
    {
        return view('pages.About');
    }
    public function Event()
    {
        return view('pages.Events');
    }
    public function Rooms()
    {
        return view('pages.Rooms');
    }
    public function Reservation($idCate)
    {

        return view('pages.Reservation', ['idCate' => $idCate]);
    }
    public function Invoice()
    {

        return view('pages.csinvoice');
    }
    public function postReservation(Request $request)
    {
        $room = Room::where('Status', 1)->where('idCategory', $request->room)->get();
        if (count($room) > 0) {
            $roomtaken = Room::where('Status', 1)->where('idCategory', $request->room)->take(1)->get();

            $this->validate(
                $request,
                [
                    'name' => 'required',
                    'email' => 'required',
                    'phone' => 'required',
                    'datein' => 'required',
                    'dateout' => 'required',
                    'numbers' => 'required'
                ],
                [
                    'name.required' => "Anda belum memasukkan nama Anda",
                    'email.required' => "Anda belum memasukkan email Anda",
                    'phone.required' => "Anda tidak memasukkan nomor telepon",
                    'datein.required' => "Anda belum memasukkan tanggal kedatangan",
                    'dateout.required' => "Anda belum memasukkan tanggal keberangkatan",
                    'numbers.required' => "Anda tidak memasukkan nomor",

                ]
            );
            $reservation = new Reservation;
            $reservation->name = $request->name;
            $reservation->email = $request->email;
            $reservation->phone = $request->phone;
            $reservation->DateIn = $request->datein;
            $reservation->DateOut = $request->dateout;
            $reservation->Numbers = $request->numbers;
            $reservation->Notes = $request->notes;
            $reservation->idRoom = $roomtaken[0]->id;
            $roomtaken[0]->Status = 0;
            $roomtaken[0]->save();

            $reservation->save();

            $r = Room::find($reservation->idRoom);
            $cate = CategoryRoom::find($r->idCategory);

            $day = (strtotime($reservation->DateOut) - strtotime($reservation->DateIn)) / 60 / 60 / 24;
            $bill = new DetailBill;
            $bill->content = 'Biaya ruangan';
            $bill->price = $cate->price * $day;
            $bill->idReservation = $reservation->id;
            $bill->created_at = $request->dateout;
            $bill->save();
            return redirect('reservation/{1}')->with('annoucement', 'Pemesanan berhasil. Kamar Anda adalah ' . $roomtaken[0]->name . '  .See you soon !');
        } else return redirect('reservation/{1}')->with('annoucement', 'Mohon maaf jenis kamar yang anda pesan sudah habis, Silahkan memilih ditanggal yang lain atau memilih jenis kamar yang berbeda. Terima Kasih');
    }
}
