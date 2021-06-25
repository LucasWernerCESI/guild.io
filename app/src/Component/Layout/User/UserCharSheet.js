import React from "react";
import {CircularProgress, IconButton} from "@material-ui/core";
import {AddCircle} from "@material-ui/icons";
import {UserInfoBox} from "./UserInfoBox";

export function UserCharSheet () {

    let user = JSON.parse( localStorage.getItem( "user" ) );

    const [hasCharacters, setHasCharacters] = React.useState( false );
    const [isLoading, setIsLoading] = React.useState( true );
    const [character, setCharacter] = React.useState({
        id: "",
        name: "",
        race: "",
        level: "",
        profession: "",
        class: "",
        faction: ""
    } );

    console.log(user)

    /* const endPoint = "http://localhost/guild/api/characters/read?userId=" + user.id;

    const headers = new Headers();
    headers.append( "Content-Type", "application/json")

    const options = {
        method: 'GET',
        headers: headers,
        mode: 'cors',
        cache: 'default'
    }

    // Handle ajax GET call
    fetch( endPoint, options )
        .then( response => {
            console.log( response )
            setHasCharacters( response.status === 200 );
            return response.json()
        } )
        .then( character => {
            console.log(character)
            setIsLoading( false );
            setCharacter( character );
        } ); */

    return (
        <>
            { isLoading &&
                <CircularProgress />
            }

            { ( !isLoading && hasCharacters ) &&
                <UserInfoBox label={"Nom"} value={ character.name } />
            }
            { ( !isLoading && !hasCharacters ) &&
                <IconButton aria-label="delete">
                    <AddCircle />
                </IconButton>
            }
        </>
    );
}