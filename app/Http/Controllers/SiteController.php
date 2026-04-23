<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\State;
use App\Models\ImageSmash;
use App\Models\CriminalCase;
use Illuminate\Http\Request;
use Butschster\Head\Facades\Meta;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{

    protected $site;
    
    
    public function __construct(Site $site){
        $this->site = $site;
    }




    // VIEW HOMEPAGE INDEX

    public function index(){
        
        return view('pages.home', [
            'pageHeadings' => [
                'True crime cases',
                'Just another true crime resource that we hope you enjoy.'
            ],
            'criminal_cases' => $this->site->criminalCases(false, 4, true),
            'criminals' => $this->site->criminals(false, 10),
            'articles' => $this->site->articles(false, 10),
            'state_counts' => $this->site->getStateCounts(false, 10),
        ]);

    }



 
    // GRAB SEARCH TERM

    public function grabSearchTerm(Request $request){
        $request->validate([
            'search_term' => ''
        ]);
        // dd($request->search_term);
        return redirect('search/'.$request->search_term);
    
        return redirect('/')->with('toast', 'Search term is empty');
    }




    // SEARCH RESULTS

    public function searchResults(string $search_term = null){

        $criminal_cases = $this->site->searchCriminalCases($search_term);
        $articles = $this->site->searchArticles($search_term);
        $criminals = $this->site->searchCriminals($search_term);

        $total_results = count($criminal_cases) + count($articles) + count($criminals);

        return view('pages.search-results', [
            'pageHeadings' => [
                'Seach results',
                $total_results . ' results found for seach term: "'.$search_term.'"'
            ],
            'criminal_cases' => $criminal_cases,
            'articles' => $articles,
            'criminals' => $criminals,
        ]);
    }

    public function viewTrialsSchedule(){

        Meta::setTitle('Upcoming trial schedule - True Crime Metrix');

        return view('pages.support', [
            'pageHeadings' => [
                'Upcoming trial schedule',
                'What trials are happening this year?'
            ]
        ]);
    }




    // VIEW SUPPORT PAGE

    public function viewSupport(){

        return redirect()->route('home');

        // Meta::setTitle('Support us - True Crime Metrix');

        // return view('pages.support', [
        //     'pageHeadings' => [
        //         'Support us',
        //         'Powered by the people. For the people.'
        //     ]
        // ]);
    }




    // VIEW ABOUT PAGE

    public function viewAbout(){

        Meta::setTitle('About us - True Crime Metrix');
        
        return view('pages.about', [
            'pageHeadings' => [
                'About us',
                'What is True Crime Metrix all about?'
            ]
        ]);

    }




    // VIEW CONTACT PAGE

    public function viewContact(){

        Meta::setTitle('Contact us - True Crime Metrix');

        return view('pages.contact', [
            'pageHeadings' => [
                'If you want to reach out to send us some information or ask any questions, you can email us here:',
                '<a href="mailto:truecrimemetrix@gmail.com">truecrimemetrix@gmail.com</a>'
            ]
        ]);

    }




    // VIEW OPPORTUNITIES PAGE

    public function viewOpportunities(){

        Meta::setTitle('Opportunities at True Crime Metrix');

        return view('pages.opportunities', [
            'pageHeadings' => [
                'Opportunities',
                'Would you like to become a content creator at True Crime Metrix?'
            ]
        ]);

    }




    // VIEW PRIVACY POLICY PAGE

    public function viewPrivacyPolicy(){

        Meta::setTitle('Privacy policy - True Crime Metrix')
            ->addMeta('robots', ['content' => 'noindex']);

        return view('pages.privacy-policy', [
            'pageHeadings' => [
                'Privacy policy',
                'View our privacy policy at True Crime Metrix.'
            ]
        ]);

    }




    // VIEW TERMS OF SERVICE PAGE

    public function viewTermsOfService(){

        Meta::setTitle('Terms of service - True Crime Metrix')
            ->addMeta('robots', ['content' => 'noindex']);


        return view('pages.terms-of-service', [
            'pageHeadings' => [
                'Terms of service',
                'View our terms of service at True Crime Metrix.'
            ],
        ]);

    }




// END OF CLASS

}
