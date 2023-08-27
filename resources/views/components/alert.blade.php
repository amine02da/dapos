@if(session()->has($type))
    {{ toastr()->success($message, "Success")  }}
@endif