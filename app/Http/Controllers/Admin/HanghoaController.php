<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateHanghoaRequest;
use App\Http\Requests\UpdateHanghoaRequest;
use App\Repositories\HanghoaRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Hanghoa;
use Flash;
use Sentinel;
use View;
use Hash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;
use Yajra\DataTables\DataTables;
use mail;

class HanghoaController extends InfyOmBaseController
{
    /** @var  HanghoaRepository */
    private $hanghoaRepository;

    public function __construct(HanghoaRepository $hanghoaRepo)
    {
        $this->hanghoaRepository = $hanghoaRepo;
    }

    /**
     * Display a listing of the Hanghoa.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->hanghoaRepository->pushCriteria(new RequestCriteria($request));
        $hanghoas = $this->hanghoaRepository->all();
        return view('admin.hanghoas.index')
            ->with('hanghoas', $hanghoas);
    }
    public function index2(Request $request)
    {


        $this->hanghoaRepository->pushCriteria(new RequestCriteria($request));
        $hanghoas = $this->hanghoaRepository->all();
        return view('admin.hanghoas.index2')
            ->with('hanghoas', $hanghoas);
    }

    /**
     * Show the form for creating a new Hanghoa.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.hanghoas.create');
    }

    /**
     * Store a newly created Hanghoa in storage.
     *
     * @param CreateHanghoaRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // $data = array(
        //     'Tensp' => $request->first_name,
        //     'Ngaynhap'=>$request->last_name,
        //     'Thongtin'=>$request->infor

        // );

        // $res = DB::table('hanghoas')->insertGetId($data);
        $hanghoa= new Hanghoa;
        $hanghoa->Tensp=$request->input('first_name');
        $hanghoa->Ngaynhap=$request->input('last_name');
        $hanghoa->Thongtin=$request->input('infor');
        $hanghoa->save();

        return redirect(route('admin.hanghoas.index'));
    }

    /**
     * Display the specified Hanghoa.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $hanghoa = $this->hanghoaRepository->findWithoutFail($id);

        if (empty($hanghoa)) {
            Flash::error('Hanghoa not found');

            return redirect(route('admin.hanghoas.index'));
        }

        return view('admin.hanghoas.show')->with('hanghoa', $hanghoa);
       
    }

    /**
     * Show the form for editing the specified Hanghoa.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function data()
    {
        //$hanghoa=DB::table('hanghoas')->where('deleted','<>','1')->orderBy('Tensp')->paginate(4);
        $hanghoa = hanghoa::where('deleted','<>','1')->orderBy('Tensp')->get();

        return DataTables::of($hanghoa)            
            ->addColumn(
                'actions',
                function ($hh) {
                    $actions = '<a href='. route('admin.hanghoas.show', $hh->id) .'><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view hàng hóa"></i></a>
                            <a href='. route('admin.hanghoas.edit', $hh->id) .'><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update hang hoa"></i></a>';
                    
                    $actions .= '<a href='. route('admin.hanghoas.confirm-delete', $hh->id) .' data-id="'.$hh->id.'" data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="user-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete hàng hóa"></i></a>';
                    

                    
                    return $actions;
                }
            )
            ->rawColumns(['actions'])
            ->make(true);
    /**
     * Create new user
     *
     * @return View
     */
    }
   

    public function data2()
    {
        $hanghoa=DB::table('hanghoas')->where('deleted','1')->get();
        //$hanghoa = DB::table('hanghoas')->orderBy('Tensp')->get();

        return DataTables::of($hanghoa)            
            ->addColumn(
                'actions',
                function ($hh) {
                    $actions = '<a href='. route('admin.hanghoas.show', $hh->id) .'><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view hàng hóa"></i></a>
                            <a href='. route('admin.hanghoas.refresh', $hh->id) .'><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="khôi phục hàng hóa"></i></a>';
                    
                    $actions .= '<a href='. route('admin.hanghoas.confirm-delete', $hh->id) .' data-id="'.$hh->id.'" data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="user-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="Xác nhận xóa"></i></a>';
                    
                    return $actions;
                }
            )
            ->rawColumns(['actions'])
            ->make(true);
    /**
     * Create new user
     *
     * @return View
     */
    }
    public function refresh($id){
        $hanghoa=hanghoa::find($id);
        $hanghoa->deleted="0";
        $hanghoa->save();
        return redirect(route('admin.index2'));


    }
    public function edit($id)
    {
        //$hanghoa = $this->hanghoaRepository->findWithoutFail($id);

         $hanghoa=Hanghoa::find($id);
        if(empty($hanghoa)){
             Flash::error('Hanghoa not found');

            return redirect(route('admin.hanghoas.index'));
            
        }
        //truyền thông tin qua input text
        $tensp=$hanghoa->Tensp;
        $ngaynhap=$hanghoa->Ngaynhap;
        $infor=$hanghoa->Thongtin;
        return view('admin.hanghoas.edit',compact('id','tensp','ngaynhap','infor'));

        //return view('admin.hanghoas.edit')->with('hanghoa', $hanghoa);
    }

    /**
     * Update the specified Hanghoa in storage.
     *
     * @param  int              $id
     * @param UpdateHanghoaRequest $request
     *
     * @return Response
     */
    
  

 
    public function update(Request $request)
    {
        $id=$request->input('id');
        
        $hanghoa=Hanghoa::find($id);
        $hanghoa->Tensp=$request->input('first_name');
        $hanghoa->Ngaynhap=$request->input('last_name');
        $hanghoa->Thongtin=$request->input('infor');
        $hanghoa->save();

        return redirect(route('admin.hanghoas.index'));
    }

    /**
     * Remove the specified Hanghoa from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.hanghoas.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }
      public function getDeletedhanghoa()
      {
        // Grab deleted users
        $hanghoa = hanghoas::onlyTrashed()->get();

        // Show the page
        return view('admin.deleted_hanghoa', compact('hanghoa'));
      }

       public function getDelete($id)
       {
           // $sample = Hanghoa::destroy($id);

           // // Redirect to the group management page
           // return redirect(route('admin.hanghoas.index'))->with('success', Lang::get('message.success.delete'));
        $hanghoa=hanghoa::find($id);
        $hanghoa->deleted="1";
        $hanghoa->save();
        return redirect(route('admin.hanghoas.index'));

       }
       public function destroy(Request $r)
    {

       $id=$r->hh;
       
       $table=Hanghoa::find($id);
       $table->delete();
       
       return redirect(route('admin.index2'));

    }
    public function test()
    {
         $data=['hoten'=>'Long'];
        Mail::send('id',$data,function($mes){
            $mes->from('shikatori1999@gmail.com','Long');
            $mes->to('shikatori1999@gmail.com','Vitor')->subject('abc');
        });
    }


      
    

}
