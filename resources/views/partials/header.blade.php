 @if (Auth::guard('client')->check())
     <header class="bg-white text-center d-flex flex-row align-items-center fixed-top pt-4 px-4 shadow-sm">
         <div>
             <a href="{{ url($lien) }}" class="text-dark"><i class="fa fa-arrow-left" style="font-size: 30px;"></i></a>
         </div>
         <div>
             <h2 class="text-dark fw-bold mx-3">{{ $nom_page }}</h2>
         </div>
         <div></div>
     </header>
     
     @elseif (Auth::guard('admin')->check()) 
     {{-- header --}}
     <header class="header text-center text-light d-flex flex-row align-items-center justify-content-between fixed-top pt-4 pb-1 px-4">
         <div>
             <a href="{{ url('liste-client') }}" class="text-light"><i class="fa fa-arrow-left" style="font-size: 30px;"></i></a>
         </div>
         <div>
             <h2 >{{ $nom_page }}</h2>
         </div>
         <div></div>
     </header>
     @else
     {{-- header --}}
     <header class="header text-center text-light d-flex flex-row align-items-center justify-content-between fixed-top pt-4 pb-1 px-4">
        <div>
            <a href="{{ url($lien) }}" class="text-light"><i class="fa fa-arrow-left" style="font-size: 30px;"></i></a>
        </div>
        <div>
            <h2 >{{ $nom_page }}</h2>
        </div>
        <div></div>
    </header>
 @endif
