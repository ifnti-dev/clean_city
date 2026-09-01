<nav class="navbar-vertical navbar">
   <div id="myScrollableElement" class="h-screen" data-simplebar>
      <!-- brand logo -->
      <a class="navbar-brand" href="{{ route('dashboard') }}">

         <div class="flex items-center">
            <span class="text-2xl font-extrabold tracking-tight text-white">
               Esp
            </span>

            <svg class="w-6 h-6 mx-0.5 text-yellow-400" fill="none" stroke="currentColor" stroke-width="1.8"
               viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
               <path
                  d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18"
                  stroke-linecap="round" stroke-linejoin="round" />
            </svg>

            <span class="text-2xl font-semibold text-white">
               ireplus
            </span>
         </div>
      </a>

      <!-- navbar nav -->
      <ul class="navbar-nav flex-col" id="sideNavbar">

         <li class="nav-item">
            <a class="nav-link active" href="{{ route('dashboard') }}">
               <i data-feather="home" class="w-4 h-4 mr-2"></i>
               Dashboard
            </a>
         </li>

         <li class="nav-item">
            <div class="navbar-heading">Menages</div>
         </li>

         <li class="nav-item">
            <a class="nav-link collapsed" href="#!" data-bs-toggle="collapse" data-bs-target="#navPages"
               aria-expanded="false" aria-controls="navPages">

               <i data-feather="layers" class="w-4 h-4 mr-2"></i>
               Menages
            </a>

            <div id="navPages" class="collapse" data-bs-parent="#sideNavbar">

               <ul class="nav flex-col">

                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('clients.index') }}">
                        Clients
                     </a>
                  </li>

                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('abonnements.index') }}">
                        Abonnées
                     </a>
                  </li>

                  <li class="nav-item">
                     <a class="nav-link" href="./billing.html">
                        Factures
                     </a>
                  </li>

                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('ramassages.index') }}">
                        Ramassages
                     </a>
                  </li>

               </ul>
            </div>
         </li>

         <li class="nav-item">
            <div class="navbar-heading">MarketPlace</div>
         </li>

         <li class="nav-item">
            <a class="nav-link collapsed" href="#!" data-bs-toggle="collapse" data-bs-target="#navComponents"
               aria-expanded="false" aria-controls="navComponents">

               <i data-feather="package" class="w-4 h-4 mr-2"></i>
               MarketPlace
            </a>

            <div id="navComponents" class="collapse" data-bs-parent="#sideNavbar">

               <ul class="nav flex-col">

                  <li class="nav-item">
                     <a class="nav-link " href="{{ route('produits.index') }}">Produits</a>
            
                  </li>

                  <li class="nav-item">
                     <a class="nav-link" href="./components/alerts.html">
                        Commandes
                     </a>
                  </li>

               </ul>
            </div>
         </li>

         <li class="nav-item">
            <div class="navbar-heading">Parametrage</div>
         </li>

         <li class="nav-item">
            <a class="nav-link" href="{{ route('employes.index') }}">
               <i data-feather="clipboard" class="w-4 h-4 mr-2"></i>
               Employes
            </a>
         </li>

         <li class="nav-item">
            <a class="nav-link" href="{{ route('roles.index') }}">
               <i data-feather="git-pull-request" class="w-4 h-4 mr-2"></i>
               Roles
            </a>
         </li>

         <li class="nav-item">
            <a class="nav-link" href="{{ route('zones.index') }}">
               <i data-feather="map" class="w-4 h-4 mr-2"></i>
               Zones
            </a>
         </li>

         <li class="nav-item">
            <a class="nav-link" href="{{ route('quartiers.index') }}">
               <i data-feather="map-pin" class="w-4 h-4 mr-2"></i>
               Quartiers
            </a>
         </li>

         <li class="nav-item">
            <a class="nav-link" href="{{ route('tarifs.index') }}">
               <i data-feather="credit-card" class="w-4 h-4 mr-2"></i>
               Tarifs
            </a>
         </li>

      </ul>
   </div>
</nav>