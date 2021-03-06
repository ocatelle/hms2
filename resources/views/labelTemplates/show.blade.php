@extends('layouts.app')

@section('pageTitle', 'Edit Label Template')

@section('content')
<h1>{{ $templateName}}</h1>
<!-- TODO: shade this area -->
<div>
    <pre>{{ $template}}</pre>
    <p/>
</div>
<div>
@can('labelTemplate.edit')
     <a href="{{ route('labels.edit', $templateName) }}" class="button">Edit</a>
      <a href="javascript:void(0);" onclick="$(this).find('form').submit();" class="alert button">
        <form action="{{ route('labels.destroy', $templateName) }}" method="POST" style="display: inline">
         {{ method_field('DELETE') }}
         {{ csrf_field() }}
         Remove
        </form>
        </a>
@endcan
@if (SiteVisitor::inTheSpace())
    @can('labelTemplate.print')
      <a href="{{ route('labels.showPrint', $templateName) }}" class="button">Print</a>
    @endcan
@endif
</div>
@endsection
