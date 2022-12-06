 <x-admin-layout>
    <div class="content content-fixed content-auth-alt">
        <div class="container ht-100p">
          <div class="ht-100p d-flex flex-column align-items-center justify-content-center">
            <div class="wd-150 wd-sm-250 mg-b-30"><img src="{{ asset('admin') }}/assets/img/welcome.png" class="img-fluid" alt=""></div>
            <h4 class="tx-20 tx-sm-24">Welcome Order Panel</h4>
            <p class="tx-color-03 mg-b-40">To continue login or register</p>
            <div class="tx-13 tx-lg-14 mg-b-40">             
                <x-element.link.primary href="{{route('login')}}" class="mg-r-10 px-10">Login</x-element.link>
                <x-element.link.light href="{{route('register')}}" class="mg-r-10 px-10">Register</x-element.link>                
            </div>         
          </div>
        </div>
      </div>
 </x-admin-layout>
