import {Divider, Typography} from "@material-ui/core";

export function GuildCardTitle ( { title } ) {
    return (
        <>
            <Typography variant={"h6"} color={"primary"}>
                { title.toUpperCase() }
            </Typography>
            <Divider/>
        </>

    )
}