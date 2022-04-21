<?php

/**
 * This file is part of Cube package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Library;

use FFI\CData;
use FFI\Env\Runtime;
use FFI\Location\Locator;
use FFI\Proxy\Proxy;

/**
 * @method int glfwInit()
 * @method void glfwTerminate()
 * @method void glfwInitHint(int $hint, int $value)
 * @method void glfwGetVersion(CData $major, CData $minor, CData $rev)
 * @method string glfwGetVersionString()
 * @method int glfwGetError(CData $description)
 * @method callable glfwSetErrorCallback(callable $callback)
 * @method CData glfwGetMonitors(CData $count)
 * @method CData glfwGetPrimaryMonitor()
 * @method void glfwGetMonitorPos(CData $monitor, CData $x, CData $y)
 * @method void glfwGetMonitorWorkarea(CData $monitor, CData $x, CData $y, CData $width, CData $height)
 * @method void glfwGetMonitorPhysicalSize(CData $monitor, CData $widthMM, CData $heightMM)
 * @method void glfwGetMonitorContentScale(CData $monitor, CData $x, CData $y)
 * @method string glfwGetMonitorName(CData $monitor)
 * @method void glfwSetMonitorUserPointer(CData $monitor, CData $pointer)
 * @method CData glfwGetMonitorUserPointer(CData $monitor)
 * @method callable glfwSetMonitorCallback(callable $callback)
 * @method CData glfwGetVideoModes(CData $monitor, CData $count)
 * @method CData glfwGetVideoMode(CData $monitor)
 * @method void glfwSetGamma(CData $monitor, float $gamma)
 * @method CData glfwGetGammaRamp(CData $monitor)
 * @method void glfwSetGammaRamp(CData $monitor, CData $ramp)
 * @method void glfwDefaultWindowHints()
 * @method void glfwWindowHint(int $hint, int $value)
 * @method void glfwWindowHintString(int $hint, string $value)
 * @method CData glfwCreateWindow(int $width, int $height, string $title, CData $monitor, CData $share)
 * @method void glfwDestroyWindow(CData $window)
 * @method int glfwWindowShouldClose(CData $window)
 * @method void glfwSetWindowShouldClose(CData $window, int $value)
 * @method void glfwSetWindowTitle(CData $window, string $title)
 * @method void glfwSetWindowIcon(CData $window, int $count, CData $images)
 * @method void glfwGetWindowPos(CData $window, CData $x, CData $y)
 * @method void glfwSetWindowPos(CData $window, int $x, int $y)
 * @method void glfwGetWindowSize(CData $window, CData $width, CData $height)
 * @method void glfwSetWindowSizeLimits(CData $window, int $minWidth, int $minHeight, int $maxWidth, int $maxHeight)
 * @method void glfwSetWindowAspectRatio(CData $window, int $numer, int $denom)
 * @method void glfwSetWindowSize(CData $window, int $width, int $height)
 * @method void glfwGetFramebufferSize(CData $window, CData $width, CData $height)
 * @method void glfwGetWindowFrameSize(CData $window, CData $left, CData $top, CData $right, CData $bottom)
 * @method void glfwGetWindowContentScale(CData $window, CData $x, CData $y)
 * @method float glfwGetWindowOpacity(CData $window)
 * @method void glfwSetWindowOpacity(CData $window, float $opacity)
 * @method void glfwIconifyWindow(CData $window)
 * @method void glfwRestoreWindow(CData $window)
 * @method void glfwMaximizeWindow(CData $window)
 * @method void glfwShowWindow(CData $window)
 * @method void glfwHideWindow(CData $window)
 * @method void glfwFocusWindow(CData $window)
 * @method void glfwRequestWindowAttention(CData $window)
 * @method CData glfwGetWindowMonitor(CData $window)
 * @method void glfwSetWindowMonitor(CData $window, CData $monitor, int $x, int $y, int $width, int $height, int $refreshRate)
 * @method int glfwGetWindowAttrib(CData $window, int $attrib)
 * @method void glfwSetWindowAttrib(CData $window, int $attrib, int $value)
 * @method void glfwSetWindowUserPointer(CData $window, CData $pointer)
 * @method CData glfwGetWindowUserPointer(CData $window)
 * @method callable glfwSetWindowPosCallback(CData $window, callable $callback)
 * @method callable glfwSetWindowSizeCallback(CData $window, callable $callback)
 * @method callable glfwSetWindowCloseCallback(CData $window, callable $callback)
 * @method callable glfwSetWindowRefreshCallback(CData $window, callable $callback)
 * @method callable glfwSetWindowFocusCallback(CData $window, callable $callback)
 * @method callable glfwSetWindowIconifyCallback(CData $window, callable $callback)
 * @method callable glfwSetWindowMaximizeCallback(CData $window, callable $callback)
 * @method callable glfwSetFramebufferSizeCallback(CData $window, callable $callback)
 * @method callable glfwSetWindowContentScaleCallback(CData $window, callable $callback)
 * @method void glfwPollEvents()
 * @method void glfwWaitEvents()
 * @method void glfwWaitEventsTimeout(float $timeout)
 * @method void glfwPostEmptyEvent()
 * @method int glfwGetInputMode(CData $window, int $mode)
 * @method void glfwSetInputMode(CData $window, int $mode, int $value)
 * @method int glfwRawMouseMotionSupported()
 * @method string glfwGetKeyName(int $key, int $scancode)
 * @method int glfwGetKeyScancode(int $key)
 * @method int glfwGetKey(CData $window, int $key)
 * @method int glfwGetMouseButton(CData $window, int $button)
 * @method void glfwGetCursorPos(CData $window, CData $x, CData $y)
 * @method void glfwSetCursorPos(CData $window, float $x, float $y)
 * @method CData glfwCreateCursor(CData $image, int $x, int $y)
 * @method CData glfwCreateStandardCursor(int $shape)
 * @method void glfwDestroyCursor(CData $cursor)
 * @method void glfwSetCursor(CData $window, CData $cursor)
 * @method callable glfwSetKeyCallback(CData $window, callable $callback)
 * @method callable glfwSetCharCallback(CData $window, callable $callback)
 * @method callable glfwSetCharModsCallback(CData $window, callable $callback)
 * @method callable glfwSetMouseButtonCallback(CData $window, callable $callback)
 * @method callable glfwSetCursorPosCallback(CData $window, callable $callback)
 * @method callable glfwSetCursorEnterCallback(CData $window, callable $callback)
 * @method callable glfwSetScrollCallback(CData $window, callable $callback)
 * @method callable glfwSetDropCallback(CData $window, callable $callback)
 * @method int glfwJoystickPresent(int $jid)
 * @method CData glfwGetJoystickAxes(int $jid, CData $count)
 * @method CData glfwGetJoystickButtons(int $jid, CData $count)
 * @method CData glfwGetJoystickHats(int $jid, CData $count)
 * @method string glfwGetJoystickName(int $jid)
 * @method string glfwGetJoystickGUID(int $jid)
 * @method void glfwSetJoystickUserPointer(int $jid, CData $pointer)
 * @method CData glfwGetJoystickUserPointer(int $jid)
 * @method int glfwJoystickIsGamepad(int $jid)
 * @method callable glfwSetJoystickCallback(callable $callback)
 * @method int glfwUpdateGamepadMappings(string $string)
 * @method string glfwGetGamepadName(int $jid)
 * @method int glfwGetGamepadState(int $jid, CData $state)
 * @method void glfwSetClipboardString(CData $window, string $string)
 * @method string glfwGetClipboardString(CData $window)
 * @method float glfwGetTime()
 * @method void glfwSetTime(float $time)
 * @method int glfwGetTimerValue()
 * @method int glfwGetTimerFrequency()
 * @method void glfwMakeContextCurrent(CData $window)
 * @method CData glfwGetCurrentContext()
 * @method void glfwSwapBuffers(CData $window)
 * @method void glfwSwapInterval(int $interval)
 * @method int glfwExtensionSupported(string $extension)
 * @method CData glfwGetProcAddress(string $procName)
 * @method int glfwVulkanSupported()
 * @method CData glfwGetRequiredInstanceExtensions(CData $count)
 *
 * ---------- Win32 ----------
 *
 * @method string glfwGetWin32Adapter(CData $monitor)
 * @method string glfwGetWin32Monitor(CData $monitor)
 * @method CData glfwGetWin32Window(CData $window)
 * @method CData glfwGetWGLContext(CData $window)
 *
 * ---------- X11 ----------
 *
 * @method CData glfwGetX11Display()
 * @method int glfwGetX11Adapter(CData $monitor)
 * @method int glfwGetX11Monitor(CData $monitor)
 * @method int glfwGetX11Window(CData $window)
 * @method void glfwSetX11SelectionString(string $string)
 * @method string glfwGetX11SelectionString()
 * @method CData glfwGetGLXContext(CData $window)
 * @method int glfwGetGLXWindow(CData $window)
 */
final class GLFW3 extends Proxy
{
    public const TRUE = 1;
    public const FALSE = 0;
    public const RELEASE = 0;
    public const PRESS = 1;
    public const REPEAT = 2;
    public const HAT_CENTERED = 0;
    public const HAT_UP = 1;
    public const HAT_RIGHT = 2;
    public const HAT_DOWN = 4;
    public const HAT_LEFT = 8;
    public const HAT_RIGHT_UP = (self::HAT_RIGHT | self::HAT_UP);
    public const HAT_RIGHT_DOWN = (self::HAT_RIGHT | self::HAT_DOWN);
    public const HAT_LEFT_UP = (self::HAT_LEFT | self::HAT_UP);
    public const HAT_LEFT_DOWN = (self::HAT_LEFT | self::HAT_DOWN);
    public const KEY_UNKNOWN = -1;
    public const KEY_SPACE = 32;
    public const KEY_APOSTROPHE = 39;
    public const KEY_COMMA = 44;
    public const KEY_MINUS = 45;
    public const KEY_PERIOD = 46;
    public const KEY_SLASH = 47;
    public const KEY_0 = 48;
    public const KEY_1 = 49;
    public const KEY_2 = 50;
    public const KEY_3 = 51;
    public const KEY_4 = 52;
    public const KEY_5 = 53;
    public const KEY_6 = 54;
    public const KEY_7 = 55;
    public const KEY_8 = 56;
    public const KEY_9 = 57;
    public const KEY_SEMICOLON = 59;
    public const KEY_EQUAL = 61;
    public const KEY_A = 65;
    public const KEY_B = 66;
    public const KEY_C = 67;
    public const KEY_D = 68;
    public const KEY_E = 69;
    public const KEY_F = 70;
    public const KEY_G = 71;
    public const KEY_H = 72;
    public const KEY_I = 73;
    public const KEY_J = 74;
    public const KEY_K = 75;
    public const KEY_L = 76;
    public const KEY_M = 77;
    public const KEY_N = 78;
    public const KEY_O = 79;
    public const KEY_P = 80;
    public const KEY_Q = 81;
    public const KEY_R = 82;
    public const KEY_S = 83;
    public const KEY_T = 84;
    public const KEY_U = 85;
    public const KEY_V = 86;
    public const KEY_W = 87;
    public const KEY_X = 88;
    public const KEY_Y = 89;
    public const KEY_Z = 90;
    public const KEY_LEFT_BRACKET = 91;
    public const KEY_BACKSLASH = 92;
    public const KEY_RIGHT_BRACKET = 93;
    public const KEY_GRAVE_ACCENT = 96;
    public const KEY_WORLD_1 = 161;
    public const KEY_WORLD_2 = 162;
    public const KEY_ESCAPE = 256;
    public const KEY_ENTER = 257;
    public const KEY_TAB = 258;
    public const KEY_BACKSPACE = 259;
    public const KEY_INSERT = 260;
    public const KEY_DELETE = 261;
    public const KEY_RIGHT = 262;
    public const KEY_LEFT = 263;
    public const KEY_DOWN = 264;
    public const KEY_UP = 265;
    public const KEY_PAGE_UP = 266;
    public const KEY_PAGE_DOWN = 267;
    public const KEY_HOME = 268;
    public const KEY_END = 269;
    public const KEY_CAPS_LOCK = 280;
    public const KEY_SCROLL_LOCK = 281;
    public const KEY_NUM_LOCK = 282;
    public const KEY_PRINT_SCREEN = 283;
    public const KEY_PAUSE = 284;
    public const KEY_F1 = 290;
    public const KEY_F2 = 291;
    public const KEY_F3 = 292;
    public const KEY_F4 = 293;
    public const KEY_F5 = 294;
    public const KEY_F6 = 295;
    public const KEY_F7 = 296;
    public const KEY_F8 = 297;
    public const KEY_F9 = 298;
    public const KEY_F10 = 299;
    public const KEY_F11 = 300;
    public const KEY_F12 = 301;
    public const KEY_F13 = 302;
    public const KEY_F14 = 303;
    public const KEY_F15 = 304;
    public const KEY_F16 = 305;
    public const KEY_F17 = 306;
    public const KEY_F18 = 307;
    public const KEY_F19 = 308;
    public const KEY_F20 = 309;
    public const KEY_F21 = 310;
    public const KEY_F22 = 311;
    public const KEY_F23 = 312;
    public const KEY_F24 = 313;
    public const KEY_F25 = 314;
    public const KEY_KP_0 = 320;
    public const KEY_KP_1 = 321;
    public const KEY_KP_2 = 322;
    public const KEY_KP_3 = 323;
    public const KEY_KP_4 = 324;
    public const KEY_KP_5 = 325;
    public const KEY_KP_6 = 326;
    public const KEY_KP_7 = 327;
    public const KEY_KP_8 = 328;
    public const KEY_KP_9 = 329;
    public const KEY_KP_DECIMAL = 330;
    public const KEY_KP_DIVIDE = 331;
    public const KEY_KP_MULTIPLY = 332;
    public const KEY_KP_SUBTRACT = 333;
    public const KEY_KP_ADD = 334;
    public const KEY_KP_ENTER = 335;
    public const KEY_KP_EQUAL = 336;
    public const KEY_LEFT_SHIFT = 340;
    public const KEY_LEFT_CONTROL = 341;
    public const KEY_LEFT_ALT = 342;
    public const KEY_LEFT_SUPER = 343;
    public const KEY_RIGHT_SHIFT = 344;
    public const KEY_RIGHT_CONTROL = 345;
    public const KEY_RIGHT_ALT = 346;
    public const KEY_RIGHT_SUPER = 347;
    public const KEY_MENU = 348;
    public const KEY_LAST = self::KEY_MENU;
    public const MOD_SHIFT = 0x0001;
    public const MOD_CONTROL = 0x0002;
    public const MOD_ALT = 0x0004;
    public const MOD_SUPER = 0x0008;
    public const MOD_CAPS_LOCK = 0x0010;
    public const MOD_NUM_LOCK = 0x0020;
    public const MOUSE_BUTTON_1 = 0;
    public const MOUSE_BUTTON_2 = 1;
    public const MOUSE_BUTTON_3 = 2;
    public const MOUSE_BUTTON_4 = 3;
    public const MOUSE_BUTTON_5 = 4;
    public const MOUSE_BUTTON_6 = 5;
    public const MOUSE_BUTTON_7 = 6;
    public const MOUSE_BUTTON_8 = 7;
    public const MOUSE_BUTTON_LAST = self::MOUSE_BUTTON_8;
    public const MOUSE_BUTTON_LEFT = self::MOUSE_BUTTON_1;
    public const MOUSE_BUTTON_RIGHT = self::MOUSE_BUTTON_2;
    public const MOUSE_BUTTON_MIDDLE = self::MOUSE_BUTTON_3;
    public const JOYSTICK_1 = 0;
    public const JOYSTICK_2 = 1;
    public const JOYSTICK_3 = 2;
    public const JOYSTICK_4 = 3;
    public const JOYSTICK_5 = 4;
    public const JOYSTICK_6 = 5;
    public const JOYSTICK_7 = 6;
    public const JOYSTICK_8 = 7;
    public const JOYSTICK_9 = 8;
    public const JOYSTICK_10 = 9;
    public const JOYSTICK_11 = 10;
    public const JOYSTICK_12 = 11;
    public const JOYSTICK_13 = 12;
    public const JOYSTICK_14 = 13;
    public const JOYSTICK_15 = 14;
    public const JOYSTICK_16 = 15;
    public const JOYSTICK_LAST = self::JOYSTICK_16;
    public const GAMEPAD_BUTTON_A = 0;
    public const GAMEPAD_BUTTON_B = 1;
    public const GAMEPAD_BUTTON_X = 2;
    public const GAMEPAD_BUTTON_Y = 3;
    public const GAMEPAD_BUTTON_LEFT_BUMPER = 4;
    public const GAMEPAD_BUTTON_RIGHT_BUMPER = 5;
    public const GAMEPAD_BUTTON_BACK = 6;
    public const GAMEPAD_BUTTON_START = 7;
    public const GAMEPAD_BUTTON_GUIDE = 8;
    public const GAMEPAD_BUTTON_LEFT_THUMB = 9;
    public const GAMEPAD_BUTTON_RIGHT_THUMB = 10;
    public const GAMEPAD_BUTTON_DPAD_UP = 11;
    public const GAMEPAD_BUTTON_DPAD_RIGHT = 12;
    public const GAMEPAD_BUTTON_DPAD_DOWN = 13;
    public const GAMEPAD_BUTTON_DPAD_LEFT = 14;
    public const GAMEPAD_BUTTON_LAST = self::GAMEPAD_BUTTON_DPAD_LEFT;
    public const GAMEPAD_BUTTON_CROSS = self::GAMEPAD_BUTTON_A;
    public const GAMEPAD_BUTTON_CIRCLE = self::GAMEPAD_BUTTON_B;
    public const GAMEPAD_BUTTON_SQUARE = self::GAMEPAD_BUTTON_X;
    public const GAMEPAD_BUTTON_TRIANGLE = self::GAMEPAD_BUTTON_Y;
    public const GAMEPAD_AXIS_LEFT_X = 0;
    public const GAMEPAD_AXIS_LEFT_Y = 1;
    public const GAMEPAD_AXIS_RIGHT_X = 2;
    public const GAMEPAD_AXIS_RIGHT_Y = 3;
    public const GAMEPAD_AXIS_LEFT_TRIGGER = 4;
    public const GAMEPAD_AXIS_RIGHT_TRIGGER = 5;
    public const GAMEPAD_AXIS_LAST = self::GAMEPAD_AXIS_RIGHT_TRIGGER;
    public const NO_ERROR = 0;
    public const NOT_INITIALIZED = 0x00010001;
    public const NO_CURRENT_CONTEXT = 0x00010002;
    public const INVALID_ENUM = 0x00010003;
    public const INVALID_VALUE = 0x00010004;
    public const OUT_OF_MEMORY = 0x00010005;
    public const API_UNAVAILABLE = 0x00010006;
    public const VERSION_UNAVAILABLE = 0x00010007;
    public const PLATFORM_ERROR = 0x00010008;
    public const FORMAT_UNAVAILABLE = 0x00010009;
    public const NO_WINDOW_CONTEXT = 0x0001000A;
    public const FOCUSED = 0x00020001;
    public const ICONIFIED = 0x00020002;
    public const RESIZABLE = 0x00020003;
    public const VISIBLE = 0x00020004;
    public const DECORATED = 0x00020005;
    public const AUTO_ICONIFY = 0x00020006;
    public const FLOATING = 0x00020007;
    public const MAXIMIZED = 0x00020008;
    public const CENTER_CURSOR = 0x00020009;
    public const TRANSPARENT_FRAMEBUFFER = 0x0002000A;
    public const HOVERED = 0x0002000B;
    public const FOCUS_ON_SHOW = 0x0002000C;
    public const RED_BITS = 0x00021001;
    public const GREEN_BITS = 0x00021002;
    public const BLUE_BITS = 0x00021003;
    public const ALPHA_BITS = 0x00021004;
    public const DEPTH_BITS = 0x00021005;
    public const STENCIL_BITS = 0x00021006;
    public const ACCUM_RED_BITS = 0x00021007;
    public const ACCUM_GREEN_BITS = 0x00021008;
    public const ACCUM_BLUE_BITS = 0x00021009;
    public const ACCUM_ALPHA_BITS = 0x0002100A;
    public const AUX_BUFFERS = 0x0002100B;
    public const STEREO = 0x0002100C;
    public const SAMPLES = 0x0002100D;
    public const SRGB_CAPABLE = 0x0002100E;
    public const REFRESH_RATE = 0x0002100F;
    public const DOUBLEBUFFER = 0x00021010;
    public const CLIENT_API = 0x00022001;
    public const CONTEXT_VERSION_MAJOR = 0x00022002;
    public const CONTEXT_VERSION_MINOR = 0x00022003;
    public const CONTEXT_REVISION = 0x00022004;
    public const CONTEXT_ROBUSTNESS = 0x00022005;
    public const OPENGL_FORWARD_COMPAT = 0x00022006;
    public const OPENGL_DEBUG_CONTEXT = 0x00022007;
    public const OPENGL_PROFILE = 0x00022008;
    public const CONTEXT_RELEASE_BEHAVIOR = 0x00022009;
    public const CONTEXT_NO_ERROR = 0x0002200A;
    public const CONTEXT_CREATION_API = 0x0002200B;
    public const SCALE_TO_MONITOR = 0x0002200C;
    public const COCOA_RETINA_FRAMEBUFFER = 0x00023001;
    public const COCOA_FRAME_NAME = 0x00023002;
    public const COCOA_GRAPHICS_SWITCHING = 0x00023003;
    public const X11_CLASS_NAME = 0x00024001;
    public const X11_INSTANCE_NAME = 0x00024002;
    public const NO_API = 0;
    public const OPENGL_API = 0x00030001;
    public const OPENGL_ES_API = 0x00030002;
    public const NO_ROBUSTNESS = 0;
    public const NO_RESET_NOTIFICATION = 0x00031001;
    public const LOSE_CONTEXT_ON_RESET = 0x00031002;
    public const OPENGL_ANY_PROFILE = 0;
    public const OPENGL_CORE_PROFILE = 0x00032001;
    public const OPENGL_COMPAT_PROFILE = 0x00032002;
    public const CURSOR = 0x00033001;
    public const STICKY_KEYS = 0x00033002;
    public const STICKY_MOUSE_BUTTONS = 0x00033003;
    public const LOCK_KEY_MODS = 0x00033004;
    public const RAW_MOUSE_MOTION = 0x00033005;
    public const CURSOR_NORMAL = 0x00034001;
    public const CURSOR_HIDDEN = 0x00034002;
    public const CURSOR_DISABLED = 0x00034003;
    public const ANY_RELEASE_BEHAVIOR = 0;
    public const RELEASE_BEHAVIOR_FLUSH = 0x00035001;
    public const RELEASE_BEHAVIOR_NONE = 0x00035002;
    public const NATIVE_CONTEXT_API = 0x00036001;
    public const EGL_CONTEXT_API = 0x00036002;
    public const OSMESA_CONTEXT_API = 0x00036003;
    public const ARROW_CURSOR = 0x00036001;
    public const IBEAM_CURSOR = 0x00036002;
    public const CROSSHAIR_CURSOR = 0x00036003;
    public const HAND_CURSOR = 0x00036004;
    public const HRESIZE_CURSOR = 0x00036005;
    public const VRESIZE_CURSOR = 0x00036006;
    public const CONNECTED = 0x00040001;
    public const DISCONNECTED = 0x00040002;
    public const JOYSTICK_HAT_BUTTONS = 0x00050001;
    public const COCOA_CHDIR_RESOURCES = 0x00051001;
    public const COCOA_MENUBAR = 0x00051002;
    public const DONT_CARE = -1;

    public function __construct()
    {
        Runtime::assertAvailable();

        $ffi = \FFI::cdef(\file_get_contents($this->getHeaders()), $this->getBinary());

        parent::__construct($ffi);
    }

    /**
     * @return non-empty-string
     */
    private function getHeaders(): string
    {
        return match (\PHP_OS_FAMILY) {
            'Windows' => __DIR__ . '/../../resources/glfw.win32.h',
            'Linux' => __DIR__ . '/../../resources/glfw.linux.h',
        };
    }

    /**
     * @return non-empty-string
     */
    private function getBinary(): string
    {
        $location = match (\PHP_OS_FAMILY) {
            'Windows' => match (\PHP_INT_SIZE) {
                8 => [__DIR__ . '/../../bin/x64/glfw3.dll'],
                4 => [__DIR__ . '/../../bin/x86/glfw3.dll'],
                default => throw new \LogicException('Unsupported OS bits'),
            },
            'Linux' => ['libglfw.so.3'],
            default => throw new \LogicException('Unsupported OS'),
        };

        return Locator::resolve(...$location)
            ?? throw new \LogicException(\sprintf(
                'Could not resolve binary pathname (%s)',
                \implode(', ', $location),
            ));
    }
}