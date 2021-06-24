import {useParams} from "react-router-dom";
import { AccessController } from "../../Controller/AccessController/AccessController";
import React from 'react';

export function Application () {

    let { guildId } = useParams();
    const storage = localStorage;

    const [values, setValues] = React.useState({
        guildId: guildId,
        userId: storage.getItem("userId"),
        playStyle: '',
        motivation: ''
    });

    return (
        <>
            {"Guild ID => " + values.guildId }
        </>
    )
}