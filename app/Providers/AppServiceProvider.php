<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use App\Models\Superadmin;
use App\Models\PropertyMdl; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    // public function trim_data($string, $val){

    //     if (strlen($string) > $val) {

    //         $stringCut = substr($string, 0, $val);
    //         $endPoint = strrpos($stringCut, ' ');
        
    //         //if the string doesn't contain any space then it will cut without word basis.
    //         $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
    //         return $string .= '...';
            
    //     }else{
    //         return $string; //$request->date_end->format('Y-m-d'); // human readable format
    //     }
    // }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
 
    


        view()->composer('admin.content.sidebar', function ($view) {

            $new = DB::table('investigate')
                    ->select('inv_id')
                    ->where('status', '=', 'new')
                    ->get();

            $pending = DB::table('investigate')
                    ->select('inv_id')
                    ->where('status', '=', 'pending')
                    ->get();
            $completed = DB::table('investigate')
                    ->select('inv_id')
                    ->where('status', '=', 'completed')
                    ->get();
            $closed = DB::table('investigate')
                    ->select('inv_id')
                    ->where('status', '=', 'closed')
                    ->get();

            $data = array(
                'new' => count($new),
                'pending' => count($pending),
                'completed' => count($completed),
                'closed' => count($closed)
            ); 

            $super_admin = 'not_exist';
            if(Superadmin::where('super_admin', auth()->user()->users_id)->exists()) {
                $super_admin = 'exist';
            }

        
            $view->with(compact('data','super_admin'));
        
        });


        view()->composer('admin.content.header', function ($view) {

            $data = DB::table('announcement')
            ->join('users', 'users.users_id', '=', 'announcement.published_by')
            ->select('announcement.*','users.firstname', 'users.lastname')
            ->where('announcement.intended_to', '=', 'agent_customer_only')
            ->orWhere('announcement.intended_to', '=', 'agent_only')
            ->limit(10)
            ->get();

            $notify_num = 0;

            foreach($data as $list){

                $res = DB::table('read_announcement') 
                        ->select('read_id')
                        ->where('announcement_id', '=', $list->announcement_id)
                        ->where('reader_id', '=', auth()->user()->users_id)
                        ->get();

                if(count($res) == 0){

                    $notify_num = $notify_num + 1;

                }

            }
            $view->with('notify_num', $notify_num);
        });

        
        view()->composer('seekers.layouts.footer', function ($view) {

            $property = PropertyMdl::select('property_id','title', 'amount', 'property_size','prop_img', 'created_at')
                            ->where('property_status','=','availables')
                            ->orderBy('created_at','ASC')
                            ->limit(3)
                            ->get();
            // $new_data = [];

            // foreach($property as $list){
            //     $new_data[] = array(
            //         'title'       => $list->title,
            //         'description' => $list->description,
            //         'prop_img'    => $list->prop_img,
            //         'created_at'  => $list->created_at
            //     );
            // }

            // $property = $new_data;

            $view->with('property', $property);
        });
    }
}
