

/**
 * Storage helper for the Moodle Tiny Autosave plugin.
 *
 * @module      tiny_keylogger/plugin
 * @copyright   2023 kuldeep singh <kuldeep@palinfocom.com>
 * @license     eLearningstack
 */

import { call } from 'core/ajax';

export const register = (editor) => {
    const postOne = (methodname, args) => call([{
        methodname,
        args,
    }])[0];
    const sendKeyEvent=(event, ed)=>{
         let ur = ed.srcElement.baseURI;
         let parm = new URL(ur);
         let recourceId=0;
         let modulename="";
        let cmid=0;
         if (ur.includes("attempt.php")||ur.includes("forum")||ur.includes("assign")){
            //return true;
         }else{
            return false;
         }
         if (ur.includes("forum")||ur.includes("assign")) {
            cmid=parm.searchParams.get('id');
        }else{
            cmid=parm.searchParams.get('cmid');
            recourceId=parm.searchParams.get('attempt');
        }
        if(recourceId===null){
            recourceId=0;
        }
        if(cmid===null){ cmid=0;}
        if (ur.includes("forum")){
            modulename="forum";
        }
        if (ur.includes("assign")){
            modulename="assign";
        }
        if (ur.includes("attempt")){
            modulename="attempt";
        }
        postOne('keylogger_json', {
            key: ed.key,
            event: event,
            keyCode: ed.keyCode,
            resourceId: recourceId,
            cmid:cmid,
            modulename:modulename
        });

    };
    editor.on('keyUp', (editor) => {
        sendKeyEvent("keyUp", editor);
    });
    editor.on('keyDown', (editor) => {
        sendKeyEvent("keyDown", editor);
    });

    editor.on('init', () => {
        // Setup the Undo handler.
    });
};
