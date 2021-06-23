import {useHistory} from "react-router-dom";
import { AccessHandler } from "../DataHandler/AccessHandler/AccessHandler";

export function Application () {

    AccessHandler();

    return (
        <>
            APPLICATION !
        </>
    )
}