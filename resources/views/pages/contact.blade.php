@extends('main')

@section('title', '- contact me')

@section('content')
            <div class="row">
                <div class="col-md-12">
                	<h1>Drop me a line or two...</h1>
                	<hr>

                	<form action="{{ url('contact') }}" method="POST"> <?php #Used url() instead of route() in the form action because we didn't set up named routes for the contact ?>
                		<div class="form-group">
                			<label name="email">Email:</label>
                			<input type="" name="email" id="email" class="form-control">
                		</div>

                		<div class="form-group">
                			<label name="subject">Subject:</label>
                			<input type="" name="subject" id="subject" class="form-control">
                		</div>
                		
                		<div class="form-group">
                			<label name="message">Message:</label>
                			<textarea type="" name="message" id="message" class="form-control">Type your message here...</textarea>
                		</div>

                		<input type="submit" name="send" value="Send message" class="btn btn-success">

                        {{ csrf_field() }} <?php # csrf_field() will create a hidden field with the token, use this when hardcoding forms; # use csrf_token() to display the token?>
                	</form>
                </div>
            </div>
@stop