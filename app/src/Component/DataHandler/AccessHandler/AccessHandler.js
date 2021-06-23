import {useHistory} from "react-router-dom";

export function AccessHandler ( ) {

    let storage = localStorage;
    let history = useHistory();

    if ( storage.getItem( "isLogged" ) === "0" ) {
        history.push( "login" );
    }

}