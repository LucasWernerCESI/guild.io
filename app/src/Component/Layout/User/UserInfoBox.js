import {Box, Typography} from "@material-ui/core";
import React from "react";

export function UserInfoBox ( { label, value } ) {

    return (

        <Box>
            <Typography variant={"caption"} >
                {label}
            </Typography>

            <Typography variant={"body1"} >
                {value}
            </Typography>
        </Box>

    )
}