Click here to reset your password:
<br>
<?php
	// need to generate a link inside the anchor tag
	// 	need to generate the link as in the password reset route : password/reset/{token}
	// need to encode the user email : urlencode()
	// save it as a $link just to facilitate and copy it to the anchor description
?>
<a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">
	{{ $link }}
</a>