import {useHistory, useLocation} from "react-router-dom";

export function AccessController ( ) {

    const location = useLocation();
    let history = useHistory();

    const user = JSON.parse( localStorage.getItem( "user" ) );

    console.log(location.pathname);

    if ( ! user.isLogged ) {
        if ( location.pathname !== "/login" && location.pathname !== "/register" ) {
            history.push( "/login" );
        }
    } else {
        if ( location.pathname === "/login" || location.pathname === "/register" ) {
            history.push( "/" );
        }
    }

}