<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
   
    .leftCol {
        text-align: right;
        padding-right: 20px;
    }
    
    .midCol {
        padding-right: 20px;
    }
    
    .rightCols {
        text-align: center;
    }
        
    .rightCol {
        opacity: 0.6;
    }
         .status_msg {
        padding: 10px;
        border: 1px solid #CCC;
        border-radius: 5px;
        margin: 20px;
        border-spacing: inherit;
        border-collapse: separate;
    }
    
    .status_msg .fa {
        font-size: 25px;
        margin-right: 25px;
    }
    
    .status_msg .green {
        color: green;
    }
        
        form {
       //  display: inline-block;
     }
     
     #product_list .fa {
         cursor: pointer;
         color: #337ab7;
         
     }
     
     #order_list {
         margin-left: 20px;
     }
    #order_list .fa{ 
         cursor: pointer;
         color: #337ab7;        
     }
     
     #order_list .middleCol {
         text-align: center;
     }
      #order_list .rightCol {
         text-align: center;
     }
        
      .leftSide {
          border-left: 3px solid #CCC;
      }
        
        table h2 {
            text-align: center;
        }
        
        .cart_items,.cart_items_form {
            width: 100%;
        }
        
        
        
        
        #MyOrder_list {
         margin-left: 20px;
     }
        
        .MyOrder_link {
            color: #333;
        }
     #MyOrder_list .middleCol {
         text-align: center;
     }
      #MyOrder_list .rightCol {
         text-align: center;
     }
        
         input[type=submit]{
                 padding: 5px;
                 padding-left: 15px;
                 padding-right: 15px;
                 margin-top: 10px;
                 margin-right: 10px;
                 color: white;
                 -webkit-border-radius: 10px;
                 -moz-border-radius: 10px;
                 border-radius: 10px;
                 border: 1px solid #999;
                  -webkit-transition: all 0.5s ease;
                -moz-transition: all 0.5s ease;
                -o-transition: all 0.5s ease;
                transition: all 0.5s ease;
             }
    
    .submitGreen {
        background-color: green;
    }
    
    .submitGreen:hover {
        color: green;
        background-color: white;
    }
    
    .submitGrey {
        background-color: grey;
    }
    
    .submitGrey:hover {
        color: grey;
        background-color: white;
    }
    
    .submitRed {
        background-color: red;
    }
    
    .submitRed:hover {
        color: red;
        background-color: white;
    }
</style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Laravel
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if(!Auth::guest() && !Auth::user()->admin)<li><a href="{{ url('/cart') }}">Cart: <b> {{ $sum }}</b>  </a> </li> @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else                   
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
