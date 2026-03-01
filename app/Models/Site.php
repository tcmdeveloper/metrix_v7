<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\State;
use App\Models\CriminalCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends Model
{

    use HasFactory;


    // GET RESOURCES

    private function getResources($model, bool $paginate = false, int $limit = null, $random = null, string $order = null, string $sort = null){

        $order = $order ?: 'created_at';
        $sort = $sort ?: 'desc';

        if($paginate){

            $limit = $limit ?: 12;
            $prepend = self::getController() == 'DashboardController' ? 'dashboard/' : null;

            return $model::orderBy($order, $sort)
                ->paginate($limit)
                ->withPath($prepend.$model->getModelData()->directory);

        }

        if($limit){
            if($random)
                return $model::inRandomOrder()->take($limit)->get();
            else
                return $model::orderBy($order, 'desc')->take($limit)->get();
        }

        return $model::orderBy($order, $sort)->get();

    }



    // RESOURCE: CRIMINAL CASES

    public function criminalCases(bool $paginate = false, int $limit = null, $random = false, $order = null, $sort = null){

        $model = new CriminalCase();
        return self::getResources($model, $paginate, $limit, $random, $order, $sort);

    }


    // RESOURCE: CATEGORIES

    public function categories(bool $paginate = false, int $limit = 30, $random = false, $order = 'name', $sort = 'ASC'){

        $model = new Category();
        return self::getResources($model, $paginate, $limit, $random, $order, $sort);

    }


    // RESOURCE: CRIMINALS

    public function criminals(bool $paginate = false, int $limit = null, $random = false, $order = null, $sort = null){

        $model = new Criminal();
        return self::getResources($model, $paginate, $limit, $random, $order, $sort);

    }


    // RESOURCE: JUDGES

    public function judges(bool $paginate = false, int $limit = null, $random = false, $order = null, $sort = null){

        $model = new Judge();
        return self::getResources($model, $paginate, $limit, $random, $order, $sort);

    }


    // RESOURCE: LAWYERS

    public function lawyers(bool $paginate = false, int $limit = null, $random = false, $order = null, $sort = null){

        $model = new Lawyer();
        return self::getResources($model, $paginate, $limit, $random, $order, $sort);

    }


    // RESOURCE: ARTICLES
    
    public function articles(bool $paginate = false, int $limit = null, $random = false, $order = null, $sort = null){

        $model = new Article();

        return self::getResources($model, $paginate, $limit, $random, $order, $sort);

    }







    private function getSearchResources($model, string $search_term, $search_field = 'title', bool $paginate = false, int $limit = null, $random = null, string $order = null, string $sort = null){

        $order = $order ?: 'created_at';
        $sort = $sort ?: 'desc';
        $search_field = $search_field ?: 'title';
        if($paginate){

            $limit = $limit ?: 12;
            $prepend = self::getController() == 'DashboardController' ? 'dashboard/' : null;

            return $model::where($search_field, 'LIKE', '%'.$search_term.'%')
                ->orderBy($order, $sort)
                ->paginate($limit)
                ->withPath($prepend.$model->getModelData()->directory);

        }

        if($limit){
            if($random)
                return $model::inRandomOrder()->take($limit)->get();
            else
                return $model::orderBy($order, 'desc')->take($limit)->get();
        }

        return $model::orderBy($order, $sort)->get();

    }




    // RESOURCE: SEARCH CRIMINAL CASES

    public function searchCriminalCases(string $search_term, string $search_field = null, bool $paginate = true, int $limit = 12, $random = false, $order = null, $sort = null){

        $model = new CriminalCase();
        return self::getSearchResources($model, $search_term, $search_field, $paginate, $limit, $random, $order, $sort);

    }


    // RESOURCE: SEARCH ARTICLES

    public function searchArticles(string $search_term, string $search_field = null, bool $paginate = true, int $limit = 12, $random = false, $order = null, $sort = null){

        $model = new Article();
        return self::getSearchResources($model, $search_term, $search_field, $paginate, $limit, $random, $order, $sort);

    }


    // RESOURCE: SEARCH CRIMINALS

    public function searchCriminals(string $search_term, string $search_field = 'first_name', bool $paginate = true, int $limit = 12, $random = false, $order = null, $sort = null){

        $model = new Criminal();
        return self::getSearchResources($model, $search_term, $search_field, $paginate, $limit, $random, $order, $sort);

    }

    




    // APP SETTINGS

    public function appSettings(){

        return AppSetting::where('hex', 'Ok5kxWz9yiW')->get()->first();

    }




    // STATES

    public function states(){

        return State::orderBy('name', 'ASC')->get();

    }


    // STATES WITH COUNT OF CRIME CASES

    public function getStateCounts(){

        $states = CriminalCase::select('state_id', DB::raw('count(*) as cases'))
        ->groupBy('state_id')
        ->orderBy('cases', 'DESC')
        ->get();

        $state_counts = [];

        foreach($states as $state){
            $state_counts[] = [
                'state' => State::find($state['state_id']),
                'cases' => $state['cases']
            ];
        }

        return $state_counts;

    }




    // GET CONTROLLER NAME

    public function getController(){

        return strtok(substr(strrchr(request()->route()->getActionName(), '\\'), 1), '@');

    }




    // GET THE METHOD IN USE

    public function getMethod(){
        list(, $method) = explode('@', Route::getCurrentRoute()->getActionName());
        return $method;
    }




    // GET TOAST MESSAGES

    public function getToastMessages($modelData){

        $method = self::getMethod();
        $label = $modelData->label;

        switch ($method){
            
            // STORE
            case 'store':
                $toast = $label.' created!';
            break;

            // UPDATE
            case 'update':
                $toast = $label.' information updated!';
            break;

            // UPDATE SINGLE TEXT FIELD
            case 'updateTextField':
                $toast = $label.' information updated!';
            break;

            // DESTROY
            case 'destroy':
                $toast = $label.' deleted!';
            break;
            
            // DEFAULT
            default:
                $toast = 'Success!';           

        }

        return $toast;

    }




    // GET PAGE HEADINGS

    public function getPageHeadings($modelData){

        $method = self::getMethod();
        $label = $modelData->label;
        $plural = $modelData->plural;

        switch ($method){
            
            // INDEX
            case 'index':
                $pageHeadings = [
                    'True crime '.$plural,
                    'Browse our full index of '.$plural.'.'
                ];
            break;

            // ADMIN INDEX
            case 'adminIndex':
                $pageHeadings = [
                    'Manage '.$plural,
                    'View, edit, manage your '.$plural.'.'
                ];
            break;

            // CREATE
            case 'create':
                $pageHeadings = [
                    'Create a new '.$label,
                    'Add the information for this '.$label.'.'
                ];
            break;

            // EDIT
            case 'edit':
                $pageHeadings = [
                    'Edit this '.$label,
                    'Update the information for this '.$label.'.'
                ];
            break;

            // CONFIRM DELETE
            case 'confirmDelete':
                $pageHeadings = [
                    'Delete this '.$label,
                    'Are you sure you want to delete this '.$label.'?'
                ];
            break;
            
            // DEFAULT
            default:
                $pageHeadings = [];
                
        }

        return $pageHeadings;

    }




    public function carbonDateFromForm($day = null, $month = null, $year = null){
        if(($year != null) && ($month != null) && ($year != null)){
            $date = $year.'-'.$month.'-'.$day;
            return Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d');
        }else{
            return null;
        }
    }
    




// END OF MODEL

}
