import { Button } from "@material-ui/core";
import { GuildTextInput } from "../../Misc/GuildTextInput";
import { GuildPwdInput } from "../../Misc/GuildPwdInput";
import { GuildDatePicker } from "../../Misc/GuildDatePicker";
import { useHistory } from "react-router-dom";
import { GuildForm } from "../../Misc/GuildForm";
import {GuildActionsBox} from "../../Misc/GuildActionsBox";
import React from "react";

export function RegisterForm () {

    let history = useHistory();

    const [values, setValues] = React.useState({
        username: '',
        mail: '',
        game: 10,
        lang: 1,
        password: '',
        passwordConfirm: '',
        birthday: ''
    });

    const handleLoginClick = () => {

        history.push( "/login" );
    }

    const handleRegisterClick = ev => {
        ev.preventDefault();
        // storage.setItem( "isLogged", "1" );
        // Handle ajax POST call
        if( values.password === values.passwordConfirm ) {
            window.location = "/";
        } else {

        }
    }

    const handleInput = prop => ev => {
        setValues({ ...values, [prop]: ev.target.value });
        console.log( values );
    };

    return (
        <GuildForm >

            <GuildTextInput
                value={values.username}
                onInput={ handleInput( 'username' ) }
                label={ "Nom d'utilisateur" }
            />

            <GuildTextInput
                autoComplete={"no"}
                value={values.mail}
                onInput={ handleInput( 'mail' ) }
                label={ "Mail" }
            />

            <GuildPwdInput
                autoComplete={"no"}
                value={values.password}
                onInput={ handleInput( 'password' ) }
                label={ "Mot de passe" }
                labelWidth={100}
            />

            <GuildPwdInput
                value={values.passwordConfirm}
                onInput={ handleInput( 'passwordConfirm' ) }
                label={ "Confirmer mot de passe" }
                labelWidth={160}
            />

            <GuildDatePicker
                onInput={ handleInput( 'birthday' ) }
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
    )
}