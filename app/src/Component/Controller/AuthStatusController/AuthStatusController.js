export function AuthStatusController () {

    // Local Storage handling
    let storage = localStorage;
    let currentUser = JSON.parse( storage.getItem( "user" ) );

    console.log( currentUser )

    // Handle login requests and redirections
    if( currentUser === null || ! currentUser.isLogged) {

         let user = {};

        user.isLogged = false;
        user.username = "guest";
        user.mail = "";
        user.birthday = "";
        user.creationDate = "";

        storage.setItem( "user", JSON.stringify( user ) );

    }

}