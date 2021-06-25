import {AddCircle} from "@material-ui/icons";
import {IconButton} from "@material-ui/core";
import React from "react";

export function UserCreateCharBtn () {

    const handleClick = () => {

    }

    return (
        <IconButton aria-label="delete" onClick={ handleClick }>
            <AddCircle />
        </IconButton>
    );
}