import {Box, Button, FormControl} from "@material-ui/core";
import { GuildTextInput } from "../../Misc/GuildTextInput";
import { GuildPwdInput } from "../../Misc/GuildPwdInput";
import { useHistory } from "react-router-dom";
import {GuildForm} from "../../Misc/GuildForm";
import {GuildActionsBox} from "../../Misc/GuildActionsBox";
import React from "react";

export function LoginForm () {

    const [values, setValues] = React.useState({
        username: '',
        password: ''
    });

    const storage = localStorage;

    let history = useHistory();

    const handleLoginClick = ev => {

        const user = JSON.parse( storage.user );

        user.isLogged = true;
        user.username = values.username;

        // Implement back-end auth
        storage.setItem( "user", JSON.stringify( user ) );
        ev.preventDefault();
        window.location = "/";
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
            />

            <GuildPwdInput
                value={values.password}
                onInput={ handleInput( 'password' ) }
                label={ "Mot de passe" }
                labelWidth={ 100 }
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