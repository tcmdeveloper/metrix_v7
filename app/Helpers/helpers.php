<?php

use Carbon\Carbon;
use App\Models\Article;
use App\Models\Criminal;
use Illuminate\Support\Str;
use App\Models\CriminalCase;
use Illuminate\Support\Facades\Vite;


    // FORMATTERS

    function showTest(){
        return 'dfsfsf';
    }



    // Show date and time
    if(!function_exists('showDateTime')){

        function showDateTime($date = null, $showTime = false, $format = null){

            $date_format = 'F j, Y';
            $time_format = 'H:i';
            
            if($format == 'short')
                $date_format = 'M d, Y';
            
            if($showTime === true)
                return $date->format($date_format).' at '.$date->format($time_format);
                
            return $date->format($date_format);
       
        }

    }

    // Show date of birth
    if(!function_exists('showDoB')){

        function showDoB($date = null){
            return Carbon::parse($date)->format('d/m/y');;
        }

    }
    
    // Page headings
    if(!function_exists('pageHeadings')){
        function pageHeadings(?string $main = null, ?string $sub = null){
            return [
                'main' => $main,
                'sub' => $sub
            ];
        }
    };


    // Get meta data
    if(!function_exists('metaData')){
        function metaData(){
            $meta_data = [
                'title' => config('meta_title'),
                'description' => config('meta_description'),
                'author' => config('meta_author'),
                'og_url' => url()->current(),
                'og_type' => 'article',
                'og_title' => config('meta_title'),
                'og_description' => config('meta_description'),
                'og_image' => config('meta_image'),
            ];
            return (object) $meta_data;
        }
    }


    // Format views
    if(!function_exists('formatViews')){
        function formatViews(int $views = 0){
            // number_format(number,decimals,decimalpoint,separator)
            return number_format($views , 0 , '.' , ',');
        }
    }



    // Convert nl to <p>
    if(!function_exists('nl2p')){
        function nl2p($string){
            $paragraphs = '';
            foreach (explode("\n", $string) as $line) {
                if (trim($line)) {
                    $paragraphs .= '<p>' . $line . '</p>';
                }
            }
            return $paragraphs;
        }
    }

    if(!function_exists('truncate')){
        function truncate($text = null){
            $text = strip_tags($text);
            $text = Str::limit($text, 50, $end='...');
            return $text;
        }
    }
    

    if(!function_exists('addView')){
        function addView($resource){
            $resource->views += 1;
            $resource->save();
            return true;
        }
    }




    //////////////////////////////////////////////


    // TRANSLATORS



    



    //////////////////////////////////////////////




    // RETRIEVAL METHODS

    if(!function_exists('environmentIsProduction')){
        function environmentIsProduction(){
            
            if(config('environment') === 'production')
                return true;
            return false;
        }
    }

    if(!function_exists('explodeCssAssets')){
        function explodeCssAssets(){
            return explode(',', config('css_assets'));
        }
    }

    if(!function_exists('explodeJsAssets')){
        function explodeJsAssets(){
            return explode(',', config('js_assets'));
        }
    }

    if(!function_exists('getMonthName')){
        function getMonthName($monthNumber)
        {
            return date("F", mktime(0, 0, 0, $monthNumber, 1));
        }
    }

    
    

    if(!function_exists('getFullName')){
        function getFullName($item = null){
            return $item->first_name.' '.$item->last_name;
        }
    }


    if(!function_exists('ckEditorId')){
        function ckEditorId($name = null){
            return 'ckEditor'.ucfirst($name);
        }
    }



    if(!function_exists('getContentOptions')){
        function getContentOptions(){
            return [
                'CriminalCase' => [
                    'title' => 'Criminal cases',
                    'buttons' => [
                        [
                            'text' => 'All criminal cases',
                            'link' => '/dashboard/criminal-cases',
                            'class' => 'btn-success'
                        ],
                        [
                            'text' => 'Create criminal case',
                            'link' => '/criminal-cases/create',
                            'class' => 'btn-action'
                        ],
                    ]
                ],
                'Category' => [
                    'title' => 'Category',
                    'buttons' => [
                        [
                            'text' => 'All categories',
                            'link' => '/dashboard/categories',
                            'class' => 'btn-success'
                        ],
                        [
                            'text' => 'Create category',
                            'link' => '/categories/create',
                            'class' => 'btn-action'
                        ],
                    ]
                ],
                'Criminal' => [
                    'title' => 'Criminals',
                    'buttons' => [
                        [
                            'text' => 'All criminals',
                            'link' => '/dashboard/criminals',
                            'class' => 'btn-success'
                        ],
                        [
                            'text' => 'Create criminal',
                            'link' => '/criminals/create',
                            'class' => 'btn-action'
                        ],
                    ]
                ],
                'Judge' => [
                    'title' => 'Judges',
                    'buttons' => [
                        [
                            'text' => 'All judges',
                            'link' => '/dashboard/judges',
                            'class' => 'btn-success'
                        ],
                        [
                            'text' => 'Create judge',
                            'link' => '/judges/create',
                            'class' => 'btn-action'
                        ],
                    ]
                ],
                'Lawyer' => [
                    'title' => 'Lawyers',
                    'buttons' => [
                        [
                            'text' => 'All lawyers',
                            'link' => '/dashboard/lawyers',
                            'class' => 'btn-success'
                        ],
                        [
                            'text' => 'Create lawyer',
                            'link' => '/lawyers/create',
                            'class' => 'btn-action'
                        ],
                    ]
                ],
                'Article' => [
                    'title' => 'Articles',
                    'buttons' => [
                        [
                            'text' => 'All articles',
                            'link' => '/dashboard/articles',
                            'class' => 'btn-success'
                        ],
                        [
                            'text' => 'Create article',
                            'link' => '/articles/create',
                            'class' => 'btn-action'
                        ],
                    ]
                ],
            ];
        }
    }
    





    