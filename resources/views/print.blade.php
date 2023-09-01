@extends('layouts.app')

@section('content')

<form id="form">
    <input type="email" name="email" id="email" placeholder="Email" />
    <br />
    <input
      type="password"
      name="password"
      id="password"
      placeholder="Password"
    />
    <br /><br />
    <button type="submit">Submit</button>
  </form>
  <br />
  <button id="save-pdf">Save PDF</button>

@endsection
