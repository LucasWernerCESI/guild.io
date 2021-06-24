import { Button } from "@material-ui/core";
import { GuildTextInput } from "../../Misc/GuildTextInput";
import { useHistory } from "react-router-dom";
import { GuildForm } from "../../Misc/GuildForm";
import { GuildActionsBox } from "../../Misc/GuildActionsBox";
import { GuildTextArea } from "../../Misc/GuildTextArea";
import React from "react";

export function SupportForm () {

    const storage = localStorage;

    let history = useHistory();

    const [values, setValues] = React.useState({
        subject: '',
        message: ''
    });

    const handleSubmit = ev => {
        ev.preventDefault();
        history.push( '/' );
    }

    // Puts input values in state
    const handleInput = prop => ev => {
        setValues({ ...values, [prop]: ev.target.value });
    };

    return (
        <GuildForm autoComplete={"false"}>

            <GuildTextInput
                value={values.subject}
                onInput={ handleInput( 'subject' ) }
                label={ "Sujet" }
            />

            <GuildTextArea
                value={values.message}
                onInput={ handleInput( 'message' ) }
                label={ "Message" }
                rows={10}
            />

            <GuildActionsBox>

                <Button
                    onClick={ handleSubmit }
                    variant={ "contained" }
                    disableElevation
                    color={ "primary" }
                >
                    Envoyer
                </Button>

            </GuildActionsBox>

        </GuildForm>
    )
}