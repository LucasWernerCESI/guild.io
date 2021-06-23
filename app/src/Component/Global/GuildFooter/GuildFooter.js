import {Container, Divider, Typography} from "@material-ui/core";
import React from "react";
import { makeStyles } from "@material-ui/styles";

const useStyles = makeStyles( {
    footer: {
        position: "relative",
        bottom: "0",
        marginBottom: "1.5%",
        marginTop: "1.5%"
    },
    footerDivider: {
        marginBottom: "1.5%"
    }
} )

export function GuildFooter () {

    const classes = useStyles();

    return (
        <Container className={ classes.footer }>
            <Divider className={ classes.footerDivider } />
            <Typography variant={"caption"}>
                Ⓒ 2021 guild.io - Lucas Werner & Lucie Desmons
            </Typography>
        </Container>
    )

}