<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\CriminalCase;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImageSmash extends Model
{
    use HasFactory;


    // FORCE TABLE NAME

    protected $table = 'images';




    // DATABASE COLUMNS FOR MASS ASSIGNMENT

    protected $fillable = [
        'hex',
        'user_id',
        'resource_model',
        'resource_id',
        'filename',
        'bg_position',
        'caption',
        'copyright',
        'copyright_link',
        'status'
    ];




    // ROUTE KEY


    // SET ROUTE KEY NAME

    public function getRouteKeyName(){

        return 'hex';
        
    }


    // RETRIEVE ROUTE KEY VALUE
    public function routeKeyValue(){

        $routeKeyValue = $this->getRouteKeyName();
        return $this->$routeKeyValue;

    }




    // GET MODEL DATA

    public function getModelData(){

        $data = (object) array(
            'name' => class_basename(__CLASS__),
            'directory' => 'images',
            'label' => 'image',
            'plural' => 'images',
        );

        return $data;

    }
    




    // LOAD RESOURCE MODEL

    // Function to load whichever model is relevant 
    // to this resource.

    public function loadModel($model_name){
        switch ($model_name){
            case 'CriminalCase':
                $model = new CriminalCase();
            break;

            case 'Criminal':
                $model = new Criminal();
            break;

            case 'Judge':
                $model = new Judge();
            break;

            case 'Article':
                $model = new Article();
            break;

            case 'ImageSmash':
                $model = new ImageSmash();
            break;
                
            default:
                $model = null;
        }

        return $model;
    }




    // CLASS NAME FROM DIRECTORY NAME

    // Function to load whichever model is relevant 
    // to this resource.

    public function classNameFromDirectoryName($directory){
        switch ($directory){
            case 'criminal-cases':
                $class_name = 'CriminalCase';
            break;

            case 'criminals':
                $class_name = 'Criminal';
            break;

            case 'judges':
                $class_name = 'Judge';
            break;

            case 'articles':
                $class_name = 'Article';
            break;
                
            default:
                $class_name = null;
        }

        return $class_name;
    }




    // GET PAGE HEADINGS

    public function getPageHeadings($resource){
        switch (self::classNameFromResource($resource)){
            case 'CriminalCase':
                $pageHeadings = [$resource->title, 'Image gallery for criminal case'];
            break;

            case 'Criminal':
                $pageHeadings = ['Criminal: '.$resource->fullName(), 'Image gallery for criminal'];
            break;

            case 'Judges':
                $pageHeadings = ['Judge: '.$resource->fullName(), 'Image gallery for judge'];
            break;

            case 'Article':
                $pageHeadings = [$resource->title, 'Image gallery for article'];
            break;
                
            default:
                $pageHeadings = [];
        }

        return $pageHeadings;
    }




    // FETCH IMAGE BY HEX

    // Returns an asset() pasth for the image with
    // the appropriate 'hex' unique identifier. This 
    // depends on the function being called on an
    // existing image object.

    public function fetchByHex($size = null){

        // Find this resource
        $resource = self::loadModel($this->resource_model)->find($this->resource_id);
        
        // Specify $full_file_path
        $full_file_path = 'images/'.str_replace('_', '-', $resource->table).'/'.$resource->hex.'/'.$this->filename;

        // If file exists, return as asset().
        if(file_exists(public_path($full_file_path)))
            return asset($full_file_path);
        
        // Else supply the file path to the
        // default image.
        return self::defaultImagePath($size);
    }




    // FETCH BY IMAGE HEX

    public function fetchByImageHex($resource, $image_hex, $size = null){

        // Image 
        $image = ImageSmash::where('hex', $image_hex)->first();  
        
        // Specify $full_file_path
        $full_file_path = 'images/'.str_replace('_', '-', $resource->table).'/'.$resource->hex.'/'.$image->filename;

        // If file exists, return as asset().
        if(file_exists(public_path($full_file_path)))
            return asset($full_file_path);
        
        // Else supply the file path to the
        // default image.
        return self::defaultImagePath($size);

    }




    // FETCH IMAGE

    // This function returns an image belonging to a resource.
    // We can select if we want to retrieve the main image for
    // this resource and set if we would like to use the thumb-
    // nail version of the image. 
    // A default image is supplied if no image is available for
    // this resource.

    public function fetch($resource = null, $fetch_main = null, $size = null){            
        // return dd($resource);
        // Get file path for this resource.
        
        $size = ($size == 'tn') ? 'tn-' : null;

        $file_path = 'images/'.str_replace('_', '-', $resource->table).'/'.$resource->hex.'/'.$size;

        // If we are fetching the main image.
        if($fetch_main){
            // Check if this resource has an image set to 'main'.
            if($resource->main_image){
                // If it does, supply the full_file_path.
                $full_file_path = $file_path.$resource->main_image->filename;
            }

            // If no image is set to main, check if the resource 
            // has any associated images and if it does, take the 
            // latest one - supplying the full_file_path.
            elseif(count($resource->images) > 0){
                $image = self::latestImageForResourceId($resource);
                if($image){
                    $filename = $image->filename;
                    $full_file_path = $file_path.$filename;
                }else{
                    $full_file_path = self::defaultImagePath($size);
                }
            }
                
            // If this resource does not have any associate 
            // images, supp full_image_path to the default image.
            else
                $full_file_path = self::defaultImagePath($size);
        }

        // If we are NOT fetching the main image.
        else{
            // Fetch the latest image record for this resource if one exists.
            // return dd($resource->images);
            if(count($resource->images) > 0){
                
                $full_file_path = $file_path.self::latestImageForResourceId($resource)->filename;
                
            }

            // Or supply the full_file_path to the default image.
            else{
                dd($resource->images);
                $full_file_path = self::defaultImagePath($size);
            }
        }
        // If the full_file_path exists, return it as an asset().
        if(file_exists(public_path($full_file_path)))
            return asset($full_file_path); 
        
        // If it does not exist supply the full_file_path to the
        // default image.
        return self::defaultImagePath($size);
    }




    // FETCH BG IMAGE POSITION

    public function fetchBgPosition($resource = null, string $bg_position = 'center'){

        if($resource->main_image)
            $bg_position = $resource->main_image->bg_position ?: $bg_position;

        return 'bg-'.$bg_position;

    }   




    // GET CLASSNAME FROM RESOURCE

    // This function returns the class name of the resource in 
    // use.

    public function classNameFromResource($resource){
        return class_basename($resource);
    }




    // GET DIRECORY NAME FROM RESOURCE TABLE NAME

    public function directoryNameFromResource($resource){
        return str_replace('_', '-', $resource->table);
    }




    // GET RESOURCE FROM DIRECTORY AND SLUG

    public function resourceFromDirectoryAndSlug($directory, $slug){
        $model_name = self::classNameFromDirectoryName($directory);
        $model = self::loadModel($model_name);       
        $resource = $model::where('slug', $slug)->first();
        return $resource;
    }




    // PATH TO DEFAULT IMAGE

    // This function supplies the full_file_path to the default
    // image. We are able to select the use of the thumbnail 
    // version.

    public function defaultImagePath($size){
        $prepend = null;
        if($size === 'tn')
            $prepend = 'tn-';
        return 'images/'.$prepend.'default-image-true-crime-metrix.webp';
    }




    // GET THE LATEST IMAGE FOR THIS RESOURCE

    // This function returns a single image record of the resource
    // we are using or returns NULL if no record exists.

    public function latestImageForResourceId($resource){
        
        $result = ImageSmash::where('resource_model', self::classNameFromResource($resource))->where('resource_id', $resource->id)->latest()->first();
        if($result)
            return $result;
        return null;
    }




    // UPLOAD IMAGE


    // This function will upload an image to the appropriate 
    // directory and create a record in the images database
    // table. If this image is set as the item's main image,
    // update the main_image_id for this item.

    public function upload($request, $resource, $image, $main_image = false){
        
        // Unique name for new file
        $image_name = self::uniqueImageName();

        // Target path to save new file
        $directory = self::directoryNameFromResource($resource);
        $directory_path = public_path('images/'.$directory.'/'.$resource->hex.'/');
        $file_path = $directory_path.$image_name;

        // Store the uploaded file
        $request->file('image')->move($directory_path, $image_name);

        // dd($file_path);
        // exit;
        // Encode image to desired format
        $image = self::encode($file_path);

        // Save the new image file name to the database
        $image = self::saveToDatabase($resource, $image, $main_image);

        return $image;
    }





    // UNIQUE IMAGE NAME

    // This function generates a unique filename to be used to
    // save the uploaded image file.

    public function uniqueImageName($file_extension = 'webp'){

        // Generate unique image name
        return Str::random('6').'-'.time().'-truecrimemetrix.'.$file_extension;
   
    }




    // ENCODE IMAGE

    // This function receives the image and image path, encoded 
    // the image and saves it to the item directory at a certain
    // quality.

    public function encode($file_path, $quality = 80, $format = 'webp'){

        // Encode to image format
        $img = Image::make($file_path)->encode($format);

        // Save image to set quality
        $img->save($file_path, $quality);

        return $img;
    }




    // SAVE TO DATABASE


    // This function will create a new record in the images
    // table and save the new image item to the database. It
    // will then return the image object.

    // $resource_type = the current resource tye
    // $resource_id = the resource id
    // $image_name = the image name

    public function saveToDatabase($resource, $image, $main_image){

        // Create a new image and store in database
        $image = ImageSmash::create([
            'hex' => Str::random(11),
            'user_id' => auth()->user()->id,
            'resource_model' => self::classNameFromResource($resource),
            'resource_id' => $resource->id,
            'directory' => self::directoryNameFromResource($resource),
            'filename' => $image->basename,
            'status' => 'public'
        ]);

        // Set main_image_id in item data table if needed
        if($main_image === true){
            $model = self::loadModel($image->resource_model)->where('hex', $resource->hex)->first();
            $model->main_image_id = $image->id;
            $model->save();
        }

        return $image;
        
    }





    // CHECK IF THIS IMAGE IS SET TO MAIN FOR THE RESOURCE
    
    public function isMainImage(){
        
        $model = self::loadModel($this->resource_model);

        $main_image_id = $model::find($this->resource_id)->main_image_id;
        if($main_image_id)
            if($this->id === $main_image_id)
                return true;
        
        return false;

    }




    // DELETE OTHER FILES IN ITEM DEIRECTORY
    
    // This function will loop through the files in 
    // the item directory. Files that are not the 
    // curreent file, it will be deleted.

    public function deleteOtherFiles($directory_path, $image_name){

        // Get file in item directory
        $files_in_folder = File::allFiles($directory_path);

        // Loop through files
        foreach($files_in_folder as $key => $path){

            // If file is not the current file
            if($path != $directory_path.'/'.$image_name){

                // Delete it
                File::delete($path);

            }

        }

        return true;
    }

    


    // RENDER CROPPED IMAGE

    // This function will accept the variable containing
    // the coordinates and dimensions for cropping the 
    // uploaded image. It will save the cropped image to
    // a desired width and height or refer to the default.
    // It will then forward to the makeThumbnail() function.

    public function renderCrop($request, $resource, $directory, $image, $width = null, $height = null){

        // Dimensions and coordinates
        $w = round($request['w']);
        $h = round($request['h']);
        $x = round($request['x']);
        $y = round($request['y']);

        
        // Directory paths
        $directory_path = 'images/'.$directory.'/'.$resource->hex.'/';
        $file_path = public_path($directory_path.$image->filename);
        
        // Open file as image resource
        $new_img = Image::make($directory_path.$image->filename);
        
        // Crop image
        $new_img->crop($w,$h,$x,$y);
        
        // Resize
        $new_img->resize($width ?: config('content_image_width'), $height ?: config('content_image_height'));
        $new_img->save($file_path);
        
        return self::makeThumbnail($new_img, $directory_path, $image->filename);
    }




    // MAKE THUMBNAIL


    // This function will resize the image to a height specified
    // height and maintain the aspect ration to determine the 
    // width of the image.

    // $img = current image
    // $directory_path = relevant directory path
    // $image_name = filename of current image
    // $height = set the height of the thumbnail


    public function makeThumbnail($img, $directory_path, $image_name, $height = 220){

        // Resize image to set height and maintain aspect ratio
        $img->resize(null, $height, function ($constraint){ 
            $constraint->aspectRatio(); 
        });

        // Prepend image namt with 'tn' and save to item directory
        $img->save($directory_path.'/tn-'.$image_name);

        return true;
    }




// END OF MODEL    

}
