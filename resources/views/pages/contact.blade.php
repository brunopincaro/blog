@extends('main')

@section('title', '- contact me')

@section('content')
            <div class="row">
                <div class="col-md-12">
                	<h1>Drop me a line or two...</h1>
                	<hr>

                	<form>
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
                	</form>
                </div>
            </div>
@stop