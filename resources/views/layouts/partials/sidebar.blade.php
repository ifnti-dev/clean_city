<nav class="navbar-vertical navbar">
   <div id="myScrollableElement" class="h-screen" data-simplebar>
      <!-- brand logo -->
      <a class="navbar-brand" href="./index.html">
         <img src="./assets/images/brand/logo/logo.svg" alt="" />
      </a>

      <!-- navbar nav -->
      <ul class="navbar-nav flex-col" id="sideNavbar">
         <li class="nav-item">
            <a class="nav-link  active " href="./index.html">
               <i data-feather="home" class="w-4 h-4 mr-2"></i>
               Dashboard
            </a>
         </li>
         <!-- nav item -->
         <li class="nav-item">
            <div class="navbar-heading">Menages</div>
         </li>
         <!-- nav item -->
         <li class="nav-item">
            <a class="nav-link  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navPages" aria-expanded="false" aria-controls="navPages">
               <i data-feather="layers" class="w-4 h-4 mr-2"></i>
               Menages
            </a>
            <div id="navPages" class="collapse " data-bs-parent="#sideNavbar">
               <ul class="nav flex-col">
                  <li class="nav-item">
                     <a class="nav-link " href="./profile.html"> Clients </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link " href="{{route('abonnees.index')}}"> Abonnée </a>
                  </li>

                  <li class="nav-item">
                     <a class="nav-link " href="./billing.html">Paiement</a>
                  </li>

                  <li class="nav-item">
                     <a class="nav-link " href="./pricing.html">Ramassage</a>
                  </li>
                  
               </ul>
            </div>
         </li>
        
         <!-- nav heading -->
         <li class="nav-item">
            <div class="navbar-heading">MarketPlace</div>
         </li>
            <!-- nav item -->
         <li class="nav-item">
               <a class="nav-link  collapsed " href="#!" data-bs-toggle="collapse"
                  data-bs-target="#navComponents" aria-expanded="false" aria-controls="navComponents">
                  <i data-feather="package" class="w-4 h-4 mr-2"></i>
                  MarketPlace
               </a>
               <div id="navComponents" class="collapse " data-bs-parent="#sideNavbar">
                  <ul class="nav flex-col">
                     <li class="nav-item">
                           <a class="nav-link " href="./components/accordions.html">Produits</a>
                     </li>

                     <li class="nav-item">
                           <a class="nav-link " href="./components/alerts.html">Commandes</a>
                     </li>

                     
                  </ul>
               </div>
         </li>

         <!-- nav item -->
         <li class="nav-item">
            <div class="navbar-heading">Parametrage</div>
         </li>

         <!-- nav item -->
         <li class="nav-item">
            <a class="nav-link " href="./docs.html">
               <i data-feather="clipboard" class="w-4 h-4 mr-2"></i>
               Employe
            </a>
         </li>
         <!-- nav item -->
         <li class="nav-item">
            <a class="nav-link " href="./changelog.html">
               <i data-feather="git-pull-request" class="w-4 h-4 mr-2"></i>
               Roles
            </a>
         </li>
         <!-- nav heading -->
         <li class="nav-item">
            <a class="nav-link" href="https://dashui.codescandy.com/tailwindcss-admin-dashboard-html-template.html" target="_blank">
               <i data-feather="download" class="w-4 h-4 mr-2"></i>
               Tarifs
            </a>
         </li>
      </ul>
   </div>
</nav>