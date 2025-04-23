<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body>
        <div class="container">
          <header class="header">
            <div class="logo-info">
                <img class="logo" src="{{ asset('images/logo.jfif') }}" alt="Logo">
                <div class="user-info">
                    <div class="name">Hi Ruel Baldo</div>
                    <div class="brgy">Brgy .04 Hernani, Eastern Samar.</div>
                </div>
            </div>
            <div class="menu-icon">
                <span class="material-icons">menu</span>
            </div>
           </header>

           <div class="hazard-prep">
                 <div class="title">
                      Hazard preparedness
                 </div>
                 <div class="hazard-content">
                     <div class="hazard-step">
                          <div class="title-step">
                              Stay Informed
                          </div>
                          <img src="{{ asset('images/slide1.png') }}" alt="" class="step-img">
                     </div>
                     <div class="hazard-step">
                          <div class="title-step">
                               Create an Emergency
                          </div>
                          <img src="{{ asset('images/slide2.png') }}" alt="" class="step-img">
                     </div>
                     <div class="hazard-step">
                          <div class="title-step">
                              Secure  Your Home
                          </div>
                          <img src="{{ asset('images/slide3.png') }}" alt="" class="step-img">
                     </div>
                 </div>
           </div>


           <div class="hazard-type">
                 <div class="title">
                       Select Hazard Area
                 </div>
                 <div class="hazard-content-type">
                     <div class="hazard-type">
                          <img src="{{ asset('images/type1.png') }}" alt="" class="type-img">
                     </div>
                     <div class="hazard-type">
                          <img src="{{ asset('images/type2.png') }}" alt="" class="type-img">
                     </div>
                     <div class="hazard-type">
                          <img src="{{ asset('images/type3.png') }}" alt="" class="type-img">
                     </div>
                     <div class="hazard-type">
                          <img src="{{ asset('images/type4.png') }}" alt="" class="type-img">
                     </div>
                 </div>
           </div>




        </div>
</body>
</html>