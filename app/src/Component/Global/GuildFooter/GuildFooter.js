import {Container, Divider, Typography} from "@material-ui/core";
import React from "react";
import './GuildFooter.css';

export function GuildFooter () {

    return (
        <Container className={"footer"}>
            <Divider className={"footer-divider"} />
            <Typography variant={"caption"}>
                Ⓒ 2021 guild.io - Lucas Werner & Lucie Desmons
            </Typography>
        </Container>
    )

}