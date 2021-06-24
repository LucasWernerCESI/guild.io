import {FormControl} from "@material-ui/core";
import {makeStyles} from "@material-ui/styles";

const useStyles = makeStyles((theme) => ({
    guildForm: {
        marginTop: theme.spacing(1),
        width: "100%",
        flexWrap: "wrap"
    }
}));

export function GuildForm ( { children, ...props} ) {

    const classes = useStyles();

    return (
        <form
            className={ classes.guildForm }
            {...props}
        >
            { children }
        </form>
    )
}