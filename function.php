{{{ Changing Forgot password page Title }}}

function change_forgot_password_title($title,$id=null){
     if ( is_wc_endpoint_url( 'lost-password' ) ) {
        $title = 'Forgot Password';   
     }
     return $title;
}
add_filter( 'the_title', 'change_forgot_password_title', 10, 2 );

{{{ /Changing Forgot password page Title }}}
