import {Box} from "@material-ui/core";
import {makeStyles} from "@material-ui/styles";

const useStyles = makeStyles( ( theme ) => ({
    actionsBox: {
        marginTop: theme.spacing(1),
        display: "flex",
        flexDirection: "row",
        gap: theme.spacing(2)
    }
}))

export function GuildActionsBox ( props ) {

    const classes = useStyles();

    return (
        <Box className={ classes.actionsBox }>
            {props.children}
        </Box>
    )
}