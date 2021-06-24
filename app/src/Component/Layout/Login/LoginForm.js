import { Button } from "@material-ui/core";
import { GuildTextInput } from "../../Misc/GuildTextInput";
import { GuildPwdInput } from "../../Misc/GuildPwdInput";
import { useHistory } from "react-router-dom";
import { GuildForm } from "../../Misc/GuildForm";
import { GuildActionsBox } from "../../Misc/GuildActionsBox";
import React from "react";
import { FormController } from "../../Controller/FormController/FormController";

export function LoginForm () {

    const [values, setValues] = React.useState({
        username: '',
        password: ''
    });

    const [errors, setErrors] = React.useState({
        username: false,
        password: false
    });

    const storage = localStorage;

    let history = useHistory();

    const handleLoginClick = ev => {

        ev.preventDefault();

        const checkedForm = FormController( values, errors );

        setErrors( checkedForm.errors );

        for ( const [key, value] of Object.entries( checkedForm.errors ) ){
            errors[key] = value;
        }

        if( checkedForm.isFormRdy ) {

            const endPoint = "http://localhost/guild/api/users/read";

            const headers = new Headers();
            headers.append( "Content-Type", "application/json")

            const options = {
                method: 'POST',
                headers: headers,
                mode: 'cors',
                cache: 'default',
                body: JSON.stringify( values )
            }

            // Handle ajax POST call
            fetch( endPoint, options )
                .then( response => response.json() )
                .then( data => {
                    console.log(data)
                    if ( data.code === 200 ) {
                        storage.setItem( "user", JSON.stringify( {
                            ...data.body,
                            isLogged: true
                        } ) );
                        console.log( storage )
                        //window.location = "/";
                    } else {
                        console.log( data.message );
                    }

                } );
        }



    }

    const handleRegisterClick = () => {
        history.push( "/register" );
    }

    const handleInput = prop => ev => {
        setValues({ ...values, [prop]: ev.target.value });
    };

    return (
        <GuildForm>

            <GuildTextInput
                value={values.username}
                onInput={ handleInput( 'username' ) }
                label={ "Nom d'utilisateur" }
                error={ errors.username }
            />

            <GuildPwdInput
                value={values.password}
                onInput={ handleInput( 'password' ) }
                label={ "Mot de passe" }
                labelWidth={ 100 }
                error={ errors.password }
            />

            <GuildActionsBox>

                <Button
                    type={"submit"}
                    onClick={ handleLoginClick }
                    variant={ "contained" }
                    disableElevation
                    color={ "primary" }
                >
                    Connexion
                </Button>

                <Button
                    onClick={ handleRegisterClick }
                    variant={ "outlined" }
                    color={ "primary" }
                >
                    Inscription
                </Button>

            </GuildActionsBox>

        </GuildForm>
    )
}