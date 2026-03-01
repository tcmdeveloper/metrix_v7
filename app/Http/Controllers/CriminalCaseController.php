<?php

namespace App\Http\Controllers;

use App\Models\CriminalCase;
use App\Models\Document;
use App\Models\Site;
use Butschster\Head\Facades\Meta;
use Illuminate\Http\Request;

class CriminalCaseController extends Controller
{
    
    protected $site, $model, $modelData, $directory, $label, $plural, $toast, $pageHeadings;


    public function __construct(){

        $this->site = new Site();
        $this->model = new CriminalCase();
        $this->modelData = $this->model->getModelData();
        $this->directory = $this->modelData->directory;
        $this->label = $this->modelData->label;
        $this->plural = $this->modelData->plural;
        $this->pageHeadings = $this->site->getPageHeadings($this->modelData);
        $this->toast = $this->site->getToastMessages($this->modelData);

    }




    // INDEX OF RESOURCES

    public function index(){

        Meta::setTitle('Criminal Cases - True Crime Metrix')
            ->setDescription('List of the true crime cases we have covered. Deep-dive information on the best cases in true crime. Statistics and news about upcoming cases, criminal news stories and data gathering.');

        return view('criminal-cases.index', [
            'pageHeadings' => [
                'Criminal Cases',
                'Here are all the cases we cover.'
            ],
            'breadcrumbs' => [
                [
                    'label' => 'Home',
                    'link' => '/'
                ],
                [
                    'label' => $this->plural,
                    'link' => '/' . $this->directory
                ]
            ],
            'criminal_cases' => $this->site->criminalCases(true)
        ]);

    }



    // SHOW SINGLE RESOURCE

    public function show(CriminalCase $criminal_case){

        Meta::setTitle($criminal_case->title . ' - True Crime Metrix')
            ->setDescription($criminal_case->caption);

        addView($criminal_case);

        return view($this->directory . '.show', [
            'pageHeadings' => [
                $criminal_case->title,
                $criminal_case->caption
            ],
            'breadcrumbs' => [
                [
                    'label' => 'Home',
                    'link' => '/'
                ],
                [
                    'label' => $this->plural,
                    'link' => '/' . $this->directory
                ],
                [
                    'label' => $criminal_case->short_name,
                    'link' => $criminal_case->link()
                ]

            ],
            'criminal_case' => $criminal_case
        ]);
    }




    // SHOW DOCUMENTS BELONGING TO A SINGLE RESOURSE

    public function showDocuments(CriminalCase $criminal_case){

        Meta::setTitle('Documents: ' . $criminal_case->title . ' - True Crime Metrix')
            ->setDescription($criminal_case->caption);

        addView($criminal_case);

        return view($this->directory . '.show-documents', [
            'pageHeadings' => [
                'Documents: ' . $criminal_case->short_name,
                'Listing documents we have collected about the Dan Markel murder case.'
            ],
            'breadcrumbs' => [
                [
                    'label' => 'Home',
                    'link' => '/'
                ],
                [
                    'label' => $this->plural,
                    'link' => '/' . $this->directory
                ],
                [
                    'label' => $criminal_case->short_name,
                    'link' => $criminal_case->link()
                ]
                ,
                [
                    'label' => 'Documents',
                    'link' => $criminal_case->link('documents')
                ]

            ],
            'criminal_case' => $criminal_case
        ]);
    }




    // SHOW PAGES OF THIS DOCUMENT

    public function showDocumentPages(CriminalCase $criminal_case, Document $document){

        Meta::setTitle('Documents: ' . $criminal_case->title . ' - True Crime Metrix')
            ->setDescription($criminal_case->caption);

        addView($document);

        return view($this->directory . '.show-document-pages', [
            'pageHeadings' => [
                $document->title,
                $document->description
            ],
            'breadcrumbs' => [
                [
                    'label' => 'Home',
                    'link' => '/'
                ],
                [
                    'label' => $this->plural,
                    'link' => '/' . $this->directory
                ],
                [
                    'label' => $criminal_case->short_name,
                    'link' => $criminal_case->link()
                ]
                ,
                [
                    'label' => 'Documents',
                    'link' => $criminal_case->link('documents')
                ]

            ],
            'criminal_case' => $criminal_case,
            'document' => $document
        ]);

    }
}
