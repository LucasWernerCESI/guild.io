import { Button } from "@material-ui/core";
import { GuildTextInput } from "../../Misc/GuildTextInput";
import { GuildPwdInput } from "../../Misc/GuildPwdInput";
import { GuildDatePicker } from "../../Misc/GuildDatePicker";
import { useHistory } from "react-router-dom";
import { GuildForm } from "../../Misc/GuildForm";
import {GuildActionsBox} from "../../Misc/GuildActionsBox";
import React from "react";
import {FormController} from "../../Controller/FormController/FormController";

export function RegisterForm () {

    let history = useHistory();

    const [values, setValues] = React.useState({
        username: '',
        mail: '',
        game: 10,
        lang: 1,
        password: '',
        passwordConfirm: '',
        birthday: '01-01-1995'
    });

    const [errors, setErrors] = React.useState({
        username: false,
        mail: false,
        game: false,
        lang: false,
        password: false,
        passwordConfirm: false,
        birthday: false
    });

    const [isRegistered, setIsRegistered] = React.useState( false );

    const handleLoginClick = () => {
        history.push( "/login" );
    }

    const handleRegisterClick = ev => {

        ev.preventDefault();

        const checkedForm = FormController( values, errors );

        setErrors( checkedForm.errors );

        for ( const [key, value] of Object.entries( checkedForm.errors ) ){
            errors[key] = value;
        }

        if( checkedForm.isFormRdy ) {

            const endPoint = "http://localhost/guild/api/users/create";

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

                    if ( data.code === 200 ) {
                        setIsRegistered( true );
                        //history.push( '/login' );
                    } else {
                        //console.log( data.message );
                    }

                } );
        }
    }

    const handleInput = prop => ev => {
        setValues({ ...values, [prop]: ev.target.value });
        console.log( values );
    };

    const handleDateChange = prop => ( ev, date ) => {
        setValues({ ...values, [prop]: date });
        console.log( date );
    };

    return (
        <>

            { ( ! isRegistered ) &&

            <GuildForm autoComplete="off">

                <GuildTextInput
                    value={ values.username }
                    onInput={ handleInput( 'username' ) }
                    label={ "Nom d'utilisateur" }
                    error={ errors.username }
                />

                <GuildTextInput
                    autoComplete={"no"}
                    value={values.mail}
                    onInput={ handleInput( 'mail' ) }
                    label={ "Mail" }
                    error={ errors.mail }
                />

                <GuildPwdInput
                    autoComplete={"no"}
                    value={values.password}
                    onInput={ handleInput( 'password' ) }
                    label={ "Mot de passe" }
                    labelWidth={100}
                    error={ errors.password }
                />

                <GuildPwdInput
                    value={ values.passwordConfirm }
                    onInput={ handleInput( 'passwordConfirm' ) }
                    label={ "Confirmer mot de passe" }
                    labelWidth={160}
                    error={ errors.passwordConfirm }
                />

                <GuildDatePicker
                    value={ values.birthday }
                    onInput={ handleDateChange( 'birthday' ) }
                    onChange={ handleDateChange( 'birthday' ) }
                    label={ "Date de naissance" }
                />

                <GuildActionsBox>

                    <Button
                        type={"submit"}
                        onClick={ handleRegisterClick }
                        variant={ "contained" }
                        disableElevation color={ "primary" }
                    >
                        Inscription
                    </Button>

                    <Button
                        onClick={ handleLoginClick }
                        variant={ "outlined" }
                        color={ "primary" }
                    >
                        Connexion
                    </Button>

                </GuildActionsBox>

            </GuildForm>

            }

            { isRegistered &&
                "Votre compte a bien été enregistré. Vous pouvez désormais vous connecter."
            }
        </>
    )
}