{{-- <div class="m-3"></div> --}}
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{url('admin/')}}">Dashboard</a></li>
  @for($i = 2; $i <= count(Request::segments()); $i++)
    <li class="breadcrumb-item">
    <a href="{{ URL::to( implode( '/', array_slice(Request::segments(), 0 ,$i, true)))}}">
        {{strtoupper(Request::segment($i))}}
    </a>
    </li>
    @endfor
  {{-- <li class="breadcrumb-item active">Dashboard</li> --}}

  <!-- Breadcrumb Menu-->
  <li class="breadcrumb-menu d-md-down-none">
    <div class="btn-group" role="group" aria-label="Button group">
      <a class="btn" href="{{url('admin/')}}"><i class="icon-graph"></i> &nbsp;Dashboard</a>
      @for($i = 2; $i <= count(Request::segments()); $i++)
      <a class="btn" href="{{ URL::to( implode( '/', array_slice(Request::segments(), 0 ,$i, true)))}}">
      <i class="icon-{{Request::segment($i)}}"></i> &nbsp;{{strtoupper(Request::segment($i))}}</a>
      @endfor
    </div>
  </li>
</ol>
