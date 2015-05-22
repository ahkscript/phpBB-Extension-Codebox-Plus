<?php
/*************************************************************************************
 * autohotkey.php
 * --------
 * Author: Naveen Garg (naveen.garg@gmail.com)
 * Copyright: (c) 2009 Naveen Garg and GeSHi
 * Release Version: 1.0.8.11-modified
 * Date Started: 2009/06/11
 *
 * AutoHotkey language file for GeSHi.
 *
 * CHANGES
 * -------
 * Release 1.0.8.5 (2009/06/11)
 * - First Release
 * 2010/10/10 by Lexikos
 * - Removed highlighting of fake/unrecognized built-in vars
 * - Fixed highlighting of keywords followed by certain symbols (DISALLOWED_AFTER)
 * 2015/05/16 by Lexikos
 * - Fixed label regex to not eat the line ending
 * - Updated keyword URLs
 *
 *************************************************************************************
 *
 *     This file is part of GeSHi.
 *
 *   GeSHi is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *   GeSHi is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with GeSHi; if not, write to the Free Software
 *   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 ************************************************************************************/

$language_data = array (
    'LANG_NAME' => 'AutoHotkey',
    'COMMENT_SINGLE' => array(
        1 => ';'
        ),
    'COMMENT_MULTI' => array('/*' => '*/'),
    'CASE_KEYWORDS' => GESHI_CAPS_NO_CHANGE,
    'QUOTEMARKS' => array('"'),
    'ESCAPE_CHAR' => '`',
    'KEYWORDS' => array(
        1 => array(
            'while','if','and','or','else','return','false','in','is','or','true','not'
            ),
        2 => array(
            // built in variables
            'A_AhkPath','A_AhkVersion','A_AppData','A_AppDataCommon',
            'A_AutoTrim','A_BatchLines','A_CaretX','A_CaretY',
            'A_ComputerName','A_ControlDelay','A_Cursor','A_DD',
            'A_DDD','A_DDDD','A_DefaultMouseSpeed','A_Desktop',
            'A_DesktopCommon','A_DetectHiddenText','A_DetectHiddenWindows','A_EndChar',
            'A_EventInfo','A_ExitReason','A_FormatFloat','A_FormatInteger',
            'A_Gui','A_GuiEvent','A_GuiControl','A_GuiControlEvent',
            'A_GuiHeight','A_GuiWidth','A_GuiX','A_GuiY',
            'A_Hour','A_IconFile','A_IconHidden','A_IconNumber',
            'A_IconTip','A_Index','A_IPAddress1','A_IPAddress2',
            'A_IPAddress3','A_IPAddress4','A_ISAdmin','A_IsCompiled',
            'A_IsCritical','A_IsPaused','A_IsSuspended','A_KeyDelay',
            'A_Language','A_LastError','A_LineFile','A_LineNumber',
            'A_LoopField','A_LoopFileAttrib','A_LoopFileDir','A_LoopFileExt',
            'A_LoopFileFullPath','A_LoopFileLongPath','A_LoopFileName','A_LoopFileShortName',
            'A_LoopFileShortPath','A_LoopFileSize','A_LoopFileSizeKB','A_LoopFileSizeMB',
            'A_LoopFileTimeAccessed','A_LoopFileTimeCreated','A_LoopFileTimeModified','A_LoopReadLine',
            'A_LoopRegKey','A_LoopRegName','A_LoopRegSubkey','A_LoopRegTimeModified',
            'A_LoopRegType','A_MDAY','A_Min','A_MM',
            'A_MMM','A_MMMM','A_Mon','A_MouseDelay',
            'A_MSec','A_MyDocuments','A_Now','A_NowUTC',
            'A_NumBatchLines','A_OSType','A_OSVersion','A_PriorHotkey',
            'A_ProgramFiles','A_Programs','A_ProgramsCommon','A_ScreenHeight',
            'A_ScreenWidth','A_ScriptDir','A_ScriptFullPath','A_ScriptName',
            'A_Sec','A_Space','A_StartMenu','A_StartMenuCommon',
            'A_Startup','A_StartupCommon','A_StringCaseSense','A_Tab',
            'A_Temp','A_ThisFunc','A_ThisHotkey','A_ThisLabel',
            'A_ThisMenu','A_ThisMenuItem','A_ThisMenuItemPos','A_TickCount',
            'A_TimeIdle','A_TimeIdlePhysical','A_TimeSincePriorHotkey','A_TimeSinceThisHotkey',
            'A_TitleMatchMode','A_TitleMatchModeSpeed','A_UserName','A_WDay',
            'A_WinDelay','A_WinDir','A_WorkingDir','A_YDay',
            'A_YEAR','A_YWeek','A_YYYY','Clipboard',
            'ClipboardAll','ComSpec','ErrorLevel','ProgramFiles','A_Is64bitOS','A_IsUnicode',
			'A_PtrSize','A_RegView','A_ScreenDPI','A_ScriptHwnd',
            ),
        3 => array(
            'AutoTrim','ComObjActive','ComObjArray','Catch','FileEncoding','FileOpen','SendLevel','SetRegView','Trim','Try','Until'
			,'ComObjConnect','ComObjCreate','ComObjError','ComObjFlags','ComObjGet','ComObjQuery','Throw'
			,'ComObjType','ComObjValue',
            'BlockInput','Break','Click',
            'ClipWait','Continue','Control',
            'ControlClick','ControlFocus','ControlGet',
            'ControlGetFocus','ControlGetPos','ControlGetText',
            'ControlMove','ControlSend','ControlSendRaw',
            'ControlSetText','CoordMode','Critical',
            'DetectHiddenText','DetectHiddenWindows','DllCall','Drive',
            'DriveGet','DriveSpaceFree',
            'Else','EnvAdd','EnvDiv',
            'EnvGet','EnvMult','EnvSet',
            'EnvSub','EnvUpdate','Exit',
            'ExitApp','FileAppend','FileCopy',
            'FileCopyDir','FileCreateDir','FileCreateShortcut',
            'FileDelete','FileGetAttrib','FileGetShortcut',
            'FileGetSize','FileGetTime','FileGetVersion',
            'FileInstall','FileMove','FileMoveDir',
            'FileRead','FileReadLine','FileRecycle',
            'FileRecycleEmpty','FileRemoveDir','FileSelectFile',
            'FileSelectFolder','FileSetAttrib','FileSetTime',
            'FormatTime','Gosub',
            'Goto','GroupActivate','GroupAdd',
            'GroupClose','GroupDeactivate','Gui',
            'GuiControl','GuiControlGet','Hotkey',
            'IfExist','IfGreater','IfGreaterOrEqual',
            'IfInString','IfLess','IfLessOrEqual',
            'IfMsgBox','IfNotEqual','IfNotExist',
            'IfNotInString','IfWinActive','IfWinExist',
            'IfWinNotActive','IfWinNotExist','ImageSearch',
            'IniDelete','IniRead','IniWrite',
            'Input','InputBox','KeyHistory',
            'KeyWait','ListHotkeys','ListLines',
            'ListVars','Loop',
            'Menu','MouseClick','MouseClickDrag',
            'MouseGetPos','MouseMove','MsgBox',
            'OnMessage','OnExit','OutputDebug',
            'PixelGetColor','PixelSearch','PostMessage',
            'Process','Progress','Random',
            'RegExMatch','RegExReplace','RegisterCallback',
            'RegDelete','RegRead','RegWrite',
            'Reload','Repeat','Return',
            'Run','RunAs','RunWait',
            'Send','SendEvent','SendInput',
            'SendMessage','SendMode','SendPlay',
            'SendRaw','SetBatchLines','SetCapslockState',
            'SetControlDelay','SetDefaultMouseSpeed','SetEnv',
            'SetFormat','SetKeyDelay','SetMouseDelay',
            'SetNumlockState','SetScrollLockState','SetStoreCapslockMode',
            'SetTimer','SetTitleMatchMode','SetWinDelay',
            'SetWorkingDir','Shutdown','Sleep',
            'Sort','SoundBeep','SoundGet',
            'SoundGetWaveVolume','SoundPlay','SoundSet',
            'SoundSetWaveVolume','SplashImage','SplashTextOff',
            'SplashTextOn','SplitPath','StatusBarGetText',
            'StatusBarWait','StringCaseSense','StringGetPos',
            'StringLeft','StringLen','StringLower',
            'StringMid','StringReplace','StringRight',
            'StringSplit','StringTrimLeft','StringTrimRight',
            'StringUpper','Suspend','SysGet',
            'Thread','ToolTip','Transform',
            'TrayTip','URLDownloadToFile','While',
            'VarSetCapacity',
            'WinActivate','WinActivateBottom','WinClose',
            'WinGet','WinGetActiveStats','WinGetActiveTitle',
            'WinGetClass','WinGetPos','WinGetText',
            'WinGetTitle','WinHide','WinKill',
            'WinMaximize','WinMenuSelectItem','WinMinimize',
            'WinMinimizeAll','WinMinimizeAllUndo','WinMove',
            'WinRestore','WinSet','WinSetTitle',
            'WinShow','WinWait','WinWaitActive',
            'WinWaitClose','WinWaitNotActive'
            ),
        4 => array(
            'Abs','ACos','Asc','ASin','Func','GetKeyName','IsByRef','IsObject','StrSplit',
            'ATan','Ceil','Chr','Cos',
            'Exp','FileExist','Floor',
            'GetKeyState','IL_Add','IL_Create','IL_Destroy',
            'InStr','IsFunc','IsLabel','Ln',
            'Log','LV_Add','LV_Delete','LV_DeleteCol',
            'LV_GetCount','LV_GetNext','LV_GetText','LV_Insert',
            'LV_InsertCol','LV_Modify','LV_ModifyCol','LV_SetImageList',
            'Mod','NumGet','NumPut',
            'Round',
            'SB_SetIcon','SB_SetParts','SB_SetText','Sin',
            'Sqrt','StrLen','SubStr','Tan',
            'TV_Add','TV_Delete','TV_GetChild','TV_GetCount',
            'TV_GetNext','TV_Get','TV_GetParent','TV_GetPrev',
            'TV_GetSelection','TV_GetText','TV_Modify',
            'WinActive','WinExist'
            ),
        5 => array(
            // #Directives
            'AllowSameLineComments','ClipboardTimeout','CommentFlag','If','IfTimeout','InputLevel','MenuMaskKey','Warn',
            'ErrorStdOut','EscapeChar','HotkeyInterval',
            'HotkeyModifierTimeout','Hotstring','IfWinActive',
            'IfWinExist','IfWinNotActive','IfWinNotExist',
            'Include','IncludeAgain','InstallKeybdHook',
            'InstallMouseHook','KeyHistory','LTrim',
            'MaxHotkeysPerInterval','MaxMem','MaxThreads',
            'MaxThreadsBuffer','MaxThreadsPerHotkey','NoEnv',
            'NoTrayIcon','Persistent','SingleInstance',
            'UseHook','WinActivateForce'
            ),
        6 => array(
            'Shift','LShift','RShift',
            'Alt','LAlt','RAlt',
            'LControl','RControl',
            'Ctrl','LCtrl','RCtrl',
            'LWin','RWin','AppsKey',
            'AltDown','AltUp','ShiftDown',
            'ShiftUp','CtrlDown','CtrlUp',
            'LWinDown','LWinUp','RWinDown',
            'RWinUp','LButton','RButton',
            'MButton','WheelUp','WheelDown',
            'WheelLeft','WheelRight','XButton1',
            'XButton2','Joy1','Joy2',
            'Joy3','Joy4','Joy5',
            'Joy6','Joy7','Joy8',
            'Joy9','Joy10','Joy11',
            'Joy12','Joy13','Joy14',
            'Joy15','Joy16','Joy17',
            'Joy18','Joy19','Joy20',
            'Joy21','Joy22','Joy23',
            'Joy24','Joy25','Joy26',
            'Joy27','Joy28','Joy29',
            'Joy30','Joy31','Joy32',
            'JoyX','JoyY','JoyZ',
            'JoyR','JoyU','JoyV',
            'JoyPOV','JoyName','JoyButtons',
            'JoyAxes','JoyInfo','Space',
            'Tab','Enter',
            'Escape','Esc','BackSpace',
            'BS','Delete','Del',
            'Insert','Ins','PGUP',
            'PGDN','Home','End',
            'Up','Down','Left',
            'Right','PrintScreen','CtrlBreak',
            'Pause','ScrollLock','CapsLock',
            'NumLock','Numpad0','Numpad1',
            'Numpad2','Numpad3','Numpad4',
            'Numpad5','Numpad6','Numpad7',
            'Numpad8','Numpad9','NumpadMult',
            'NumpadAdd','NumpadSub','NumpadDiv',
            'NumpadDot','NumpadDel','NumpadIns',
            'NumpadClear','NumpadUp','NumpadDown',
            'NumpadLeft','NumpadRight','NumpadHome',
            'NumpadEnd','NumpadPgup','NumpadPgdn',
            'NumpadEnter','F1','F2',
            'F3','F4','F5',
            'F6','F7','F8',
            'F9','F10','F11',
            'F12','F13','F14',
            'F15','F16','F17',
            'F18','F19','F20',
            'F21','F22','F23',
            'F24','Browser_Back','Browser_Forward',
            'Browser_Refresh','Browser_Stop','Browser_Search',
            'Browser_Favorites','Browser_Home','Volume_Mute',
            'Volume_Down','Volume_Up','Media_Next',
            'Media_Prev','Media_Stop','Media_Play_Pause',
            'Launch_Mail','Launch_Media','Launch_App1',
            'Launch_App2'
            ),
        7 => array(
            // Gui commands
            'Add','New','GuiDropFiles',
            'Show', 'Submit', 'Cancel', 'Destroy',
            'Font', 'Color', 'Margin', 'Flash', 'Default',
            'GuiEscape','GuiClose','GuiSize','GuiContextMenu','GuiDropFilesTabStop',
            ),
        8 => array(
            // Gui Controls
            'Button','Custom','GroupBox','StatusBar','Tab','StatusBar',
            'Checkbox','Radio','DropDownList','DDL',
            'ComboBox','ListBox','ListView',
            'Text', 'Edit', 'UpDown', 'Picture',
            'TreeView','DateTime', 'MonthCal',
            'Slider'
            )
        ),
    'SYMBOLS' => array(
        '(',')','[',']',
        '+','-','*','/','&','^',
        '=','+=','-=','*=','/=','&=',
        '==','<','<=','>','>=',':=',
        ',','.'
        ),
    'CASE_SENSITIVE' => array(
        GESHI_COMMENTS => false,
        1 => false,
        2 => false,
        3 => false,
        4 => false,
        5 => false,
        6 => false,
        7 => false,
        8 => false
        ),
    'STYLES' => array(
        'KEYWORDS' => array(
            1 => 'color: #480048; font-weight: bolder; font-style: italic;',       // reserved #blue
            2 => 'color: #CF00CF; font-weight: bolder; font-style: italic;',                         // BIV yellow
            3 => 'color: #004080; font-weight: bolder;',       // commands purple
            4 => 'color: #0F707F; font-style: italic;',       // functions #0080FF
            5 => 'color: #F04020; font-weight: bolder; font-style: italic; ',    // directives #black
            6 => 'color: #FF00FF; font-weight: bolder;',      // hotkeys #red
            7 => 'color: #004080; font-weight: bolder;',    // gui commands #black
            8 => 'color: #004080; font-weight: bolder;'      // gui controls
            ),
        'COMMENTS' => array(
            'MULTI' => 'font-style: italic; color: gray;',
            1 => 'font-style: italic; color: #008000;'
            ),
        'ESCAPE_CHAR' => array(
            0 => 'color: #FF8000; font-weight: bold; '
            ),
        'BRACKETS' => array(
            0 => 'color: brown; font-weight: bold;'
            ),
        'STRINGS' => array(
            0 => ' color: #404040;'
            ),
        'NUMBERS' => array(
            0 => 'color: #2F4F7F;'
            ),
        'METHODS' => array(
            1 => 'color: #0000FF; font-style: italic; '
            ),
        'SYMBOLS' => array(
            0 => 'color: #7F200F; font-weight: bold;'
            ),
        'REGEXPS' => array(
            0 => 'font-weight: italic; color: #A00A0;',
            1 => 'color: #CC0000; font-style: italic;',
            2 => 'color: #DD0000; font-style: italic;'
            ),
        'SCRIPT' => array(
            )
        ),
    'OOLANG' => false,
    'OBJECT_SPLITTERS' => array(
        1 => '_'
        ),
    'REGEXPS' => array(
        //Variables
        0 => '%[a-zA-Z_][a-zA-Z0-9_]*%',
        //hotstrings
        1 => '::[\w\d]+::',
        //labels
		2 => '\w+:(?=\s)'
		// Lexikos: More complicated regex seems unnecessary:
        //2 => '(?m:^)[ \t]*\K[^ \t\r\n,:]+:(?=[ \t]*(?m:$))' // Lexikos: Without \K, the first '<' of the span somehow gets eaten (seems to be a bug).
        ),
    'URLS' => array(
        1 => '',
        2 => 'http://ahkscript.org/docs/{FNAME}',
        3 => 'http://ahkscript.org/docs/{FNAME}',
        4 => 'http://ahkscript.org/docs/{FNAME}',
        5 => 'http://ahkscript.org/docs/%23{FNAME}',
        6 => 'http://ahkscript.org/docs/KeyList.htm',
        7 => 'http://ahkscript.org/docs/commands/Gui.htm#{FNAME}',
        8 => 'http://ahkscript.org/docs/commands/GuiControls.htm#{FNAME}'
        ),
    'STRICT_MODE_APPLIES' => GESHI_MAYBE,
    'SCRIPT_DELIMITERS' => array(
        ),
    'HIGHLIGHT_STRICT_BLOCK' => array(
        0 => true,
        1 => true,
        2 => true,
        3 => true
        ),
    'PARSER_CONTROL' => array(
        'KEYWORDS' => array(
            5 => array(
                'DISALLOWED_BEFORE' => '(?<!\w)\#'
                ),
			'DISALLOWED_AFTER' => '(?![a-zA-Z0-9_#@$])'
            ),
        )
);

?>