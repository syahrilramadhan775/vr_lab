<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>


<li class='nav-item'><a class='nav-link' href='{{ backpack_url('content') }}'><i class="nav-icon las la-book"></i> My Content  </a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('all-content') }}">  <i class="nav-icon las la-stream"></i> Content </a></li>
{{-- <li class='nav-item'><a class='nav-link' href='{{ backpack_url('upgrade') }}'><i class='nav-icon la la-question'></i> Upgrades</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('upgrade') }}'><i class='nav-icon la la-question'></i> Profile </a></li> --}}
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('subscribe') }}'><i class="las la-chevron-up nav-icon"></i> Subscription </a></li>