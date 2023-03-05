<?php

namespace Modules\Home\Http\Controllers\Admin;

use Modules\Home\Filters\SalaryFilter;
use Modules\Home\Models\Country;
use Modules\Home\Models\Profession;
use Modules\Home\Models\Salary;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use PhpParser\Node\Stmt\Echo_;
use function view;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(SalaryFilter $filter)
    {


//        return view('home::admin.test');
//        $this->ccc();

//        $sal = Salary::all();
//
//        foreach ($sal as $sss){
//            $this->calculateIndex($sss->id);
//        }
//        dd('good');
        $heads = [
            'ID',
            'Amount',
            'Profession',
            'Country',
            //['label' => 'Phone', 'width' => 40],
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];

        $data = Salary::filter($filter)->get();

        $salaries = [];

        foreach ($data as $salary)
        {

            $li = '<i class="fa fa-lg fa-fw fa-eye"></i>';
            if($salary->status == 0)
            {
                $li = '<i class="fa fa-lg fa-fw fa-eye-slash text-red"></i>';
            }

            $btnEdit = '<a href="salary/'. $salary->id . '/edit" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>';
            $btnDelete = '<button name="delete" data-id="'. $salary->id .'" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                      </button>';
            $btnDetails = '<button name="status" data-id="'. $salary->id .'" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">'.$li.'</button>';

            //fa-eye-slash
            $salaryArr = [];
            $salaryArr['id'] = $salary->id;
            $salaryArr['amount'] = $salary->amount;
            $salaryArr['profession_id'] = '<a href="professions/'.$salary->profession->id.'/edit'.'">'.$salary->profession->name.'</a>';;
            $salaryArr['country_id'] = '<a href="country/'.$salary->country->id.'/edit'.'">'. $salary->country->name .'</a>';
            $salaryArr['btns'] = '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>';
            $salaries[] = $salaryArr;

        }

        $professions = Profession::all();
        $countries = Country::all();

        return view('home::admin.salary.index', compact('salaries', 'heads', 'professions', 'countries'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $action = 'Creating';
        $professions = Profession::all();
        $countries = Country::all();


        return view('home::admin.salary.form', compact('action', 'professions', 'countries'));    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $data = [
            'amount' => $request->amount,
            'status' => isset($request->status) ? 1 : 0,
            'profession_id' => $request->profession,
            'country_id' => $request->country,
        ];




        $salary = new Salary();

        $salary->fill($data)->save();

        if($request->amount){
            $this->calculateIndex($salary->id, $request->amount);
        }
        return $salary->id;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('home::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $action = 'Edit';
        $model = Salary::findOrFail($id);
        $professions = Profession::all();


//        foreach ($professions as $pro)
//        {
//          echo  isset($pro->category) ? $pro->category->name. '<br>' : '---'. '<br>';
//        }
//                echo '<br>';
//            } else{
//                echo '---';
//                echo '<br>';
//            }
//        }
//        dd($professions[102]->category);


        $countries = Country::all();

//        dd($model);

        return view('home::admin.salary.form', compact('action', 'model', 'professions', 'countries'));

    }
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {

        $data = [
            'amount' => $request->amount,
            'status' => $request->status ? 1 : 0,
            'profession_id' => $request->profession,
            'country_id' => $request->country,
        ];

        $salary = Salary::findOrFail($id);

        if($salary->amount){
            $this->calculateIndex($id, $request->amount);
        }

        $salary->update($data);

        return $salary->id;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $model = Salary::findOrFail($id);
        $model->delete();

        return $id;
    }

    public function changeStatus($id)
    {

        $model = Salary::findOrFail($id);

        $model->status = $model->status ? 0 : 1;
        $model->save();

        return $model->id;
    }

    public function calculateIndex($id, $amount = 0)
    {

        $model = Salary::findOrFail($id);
        $country = Country::findOrFail($model->country_id);

        $cost_live = $country->cost_live;
        $rent = $country->rent;
        $square_meter = $country->square_meter;

        if(!$model->amount){
            $error = ['error' => 'Hevent amount'];
            return json_encode($error);
        }
        if(!$cost_live || !$rent || !$square_meter){
            $error = ['error' => 'Hevent cost live parameters'];
            return json_encode($error);
        }

        $amountVal = $model->amount;
        if($amount > 0){
            $amountVal = $amount;
        }

        $respect_index = round($amountVal/($cost_live + $rent + (0.3*$square_meter)), 3);

        $model->respect_index = $respect_index;
        $model->save();

        return $model->respect_index;
    }

    public function ccc()
    {
        $sum =400;
        $mon =0;
        $mon_lost =0;
        $dayys =30;
        $lost_day = 9;
        $i =1;
        $i2 =1;
        $procent = 0.1;

        while ($i <= ($dayys-$lost_day))
        {
            $i++;
            $mon+= $procent*$sum;
        }
        while ($i2 <= $lost_day)
        {
            $i2++;
            $mon_lost+= 0.2*$sum;
        }


//        dump($mon);
//        echo '-------';
//        echo '<br>';
//        dump($mon_lost);
        echo '-------';
//        echo '<br>';
//
//        echo $mon;

        echo '<br>';
        echo $mon-$mon_lost;
        echo '<br>';

        echo '-------';
        echo '<br>';

//        $start = 500;
        $start = 40;//main
//        $start = 17.47;
        $finish = 400;
        $days = 1;
        $date = date('d', '1677075133');
        $date_now = date('d');

        $d = $date_now - $date;

//        dd($d);
        $class = '';


        while ($start <= $finish)
        {
            if($days <= $d){
                $class = 'style="color:green;"';
            } else{
                $class = '';
            }
            echo '<p '.$class.'>money on '.$days .' day is - '. round($start, 2). ' | on day: '. round($start*$procent, 2).'</p>';
//            echo '<br>';

            $start+=($start*$procent);
            $days++;
        }
        echo '<p'.$class.'>all days need '.$days .' day is - '. round($start, 2). ' | on day: '. round($start*$procent, 2).'</p>';
        echo '<br>';
        dd(2);
    }
}
