<?php

/**
 * This file is part of opengl-experiments package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Library;

use FFI\CData;

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
interface GLFW3
{
}
