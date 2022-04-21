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
use FFI\ParserException;
use FFI\Proxy\Proxy;
use FFI\Scalar\Type;

/**
 * ---------- WGL ----------
 *
 * @method int wglChoosePixelFormat(CData $hdc, CData $pPfd)
 * @method int wglDescribePixelFormat(CData $hdc, int $ipfd, int $cjpfd, CData $ppfd)
 * @method int wglGetPixelFormat(CData $hdc)
 * @method int wglSetPixelFormat(CData $hdc, int $ipfd, CData $ppfd)
 * @method int wglSwapBuffers(CData $hdc)
 * @method int wglCopyContext(CData $hglRcSrc, CData $hglRcDst, int $mask)
 * @method CData wglCreateContext(CData $hdc)
 * @method CData wglCreateLayerContext(CData $hdc, int $level)
 * @method int wglDeleteContext(CData $oldContext)
 * @method int wglDescribeLayerPlane(CData $hdc, int $pixelFormat, int $layerPlane, int $nBytes, CData $plpd)
 * @method CData wglGetCurrentContext()
 * @method CData wglGetCurrentDC()
 * @method int wglGetLayerPaletteEntries(CData $hdc, int $iLayerPlane, int $iStart, int $cEntries, CData $pcr)
 * @method CData wglGetProcAddress(string $lpszProc)
 * @method int wglMakeCurrent(CData $hdc, CData $newContext)
 * @method int wglRealizeLayerPalette(CData $hdc, int $iLayerPlane, int $bRealize)
 * @method int wglSetLayerPaletteEntries(CData $hdc, int $iLayerPlane, int $iStart, int $cEntries, CData $pcr)
 * @method int wglShareLists(CData $hrcSrvShare, CData $hrcSrvSource)
 * @method int wglSwapLayerBuffers(CData $hdc, int $fuFlags)
 * @method int wglUseFontBitmapsA(CData $hdc, int $first, int $count, int $listBase)
 * @method int wglUseFontBitmapsW(CData $hdc, int $first, int $count, int $listBase)
 * @method int wglUseFontOutlinesA(CData $hdc, int $first, int $count, int $listBase, float $deviation, float $extrusion, int $format, CData $lpgmf)
 * @method int wglUseFontOutlinesW(CData $hdc, int $first, int $count, int $listBase, float $deviation, float $extrusion, int $format, CData $lpgmf)
 *
 * ---------- GLX ----------
 *
 * @method CData glXChooseVisual(CData $dpy, int $screen, CData $attrib_list)
 * @method void glXCopyContext(CData $dpy, CData $src, CData $dst, int $mask)
 * @method CData glXCreateContext(CData $dpy, CData $vis, CData $share_list, bool $direct)
 * @method int glXCreateint(CData $dpy, CData $vis, int $pixmap)
 * @method void glXDestroyContext(CData $dpy, CData $ctx)
 * @method void glXDestroyint(CData $dpy, int $pix)
 * @method int glXGetConfig(CData $dpy, CData $vis, int $attrib, CData $value)
 * @method CData glXGetCurrentContext()
 * @method int glXGetCurrentDrawable()
 * @method bool glXIsDirect(CData $dpy, CData $ctx)
 * @method bool glXMakeCurrent(CData $dpy, int $drawable, CData $ctx)
 * @method bool glXQueryExtension(CData $dpy, CData $error_base, CData $event_base)
 * @method bool glXQueryVersion(CData $dpy, CData $major, CData $minor)
 * @method void glXSwapBuffers(CData $dpy, int $drawable)
 * @method void glXUseXFont(int $font, int $first, int $count, int $list_base)
 * @method void glXWaitGL()
 * @method void glXWaitX()
 * @method string glXGetClientString(CData $dpy, int $name)
 * @method string glXQueryServerString(CData $dpy, int $screen, int $name)
 * @method string glXQueryExtensionsString(CData $dpy, int $screen)
 * @method CData glXGetCurrentDisplay()
 * @method CData glXChooseFBConfig(CData $dpy, int $screen, CData $attrib_list, CData $nelements)
 * @method CData glXCreateNewContext(CData $dpy, CData $config, int $render_type, CData $share_list, bool $direct)
 * @method int glXCreatePbuffer(CData $dpy, CData $config, CData $attrib_list)
 * @method int glXCreatePixmap(CData $dpy, CData $config, int $pixmap, CData $attrib_list)
 * @method int glXCreateWindow(CData $dpy, CData $config, int $win, CData $attrib_list)
 * @method void glXDestroyPbuffer(CData $dpy, int $pbuf)
 * @method void glXDestroyPixmap(CData $dpy, int $pixmap)
 * @method void glXDestroyWindow(CData $dpy, int $win)
 * @method int glXGetCurrentReadDrawable()
 * @method int glXGetFBConfigAttrib(CData $dpy, CData $config, int $attribute, CData $value)
 * @method CData glXGetFBConfigs(CData $dpy, int $screen, CData $nelements)
 * @method void glXGetSelectedEvent(CData $dpy, int $draw, CData $event_mask)
 * @method CData glXGetVisualFromFBConfig(CData $dpy, CData $config)
 * @method bool glXMakeContextCurrent(CData $display, int $draw, int $read, CData $ctx)
 * @method int glXQueryContext(CData $dpy, CData $ctx, int $attribute, CData $value)
 * @method void glXQueryDrawable(CData $dpy, int $draw, int $attribute, CData $value)
 * @method void glXSelectEvent(CData $dpy, int $draw, int $event_mask)
 * @method callable|CData glXGetProcAddress(CData $name)
 */
final class GL extends Proxy
{
    public const DEPTH_BUFFER_BIT = 0x00000100;
    public const STENCIL_BUFFER_BIT = 0x00000400;
    public const COLOR_BUFFER_BIT = 0x00004000;
    public const FALSE = 0;
    public const TRUE = 1;
    public const POINTS = 0x0000;
    public const LINES = 0x0001;
    public const LINE_LOOP = 0x0002;
    public const LINE_STRIP = 0x0003;
    public const TRIANGLES = 0x0004;
    public const TRIANGLE_STRIP = 0x0005;
    public const TRIANGLE_FAN = 0x0006;
    public const QUADS = 0x0007;
    public const NEVER = 0x0200;
    public const LESS = 0x0201;
    public const EQUAL = 0x0202;
    public const LEQUAL = 0x0203;
    public const GREATER = 0x0204;
    public const NOTEQUAL = 0x0205;
    public const GEQUAL = 0x0206;
    public const ALWAYS = 0x0207;
    public const ZERO = 0;
    public const ONE = 1;
    public const SRC_COLOR = 0x0300;
    public const ONE_MINUS_SRC_COLOR = 0x0301;
    public const SRC_ALPHA = 0x0302;
    public const ONE_MINUS_SRC_ALPHA = 0x0303;
    public const DST_ALPHA = 0x0304;
    public const ONE_MINUS_DST_ALPHA = 0x0305;
    public const DST_COLOR = 0x0306;
    public const ONE_MINUS_DST_COLOR = 0x0307;
    public const SRC_ALPHA_SATURATE = 0x0308;
    public const NONE = 0;
    public const FRONT_LEFT = 0x0400;
    public const FRONT_RIGHT = 0x0401;
    public const BACK_LEFT = 0x0402;
    public const BACK_RIGHT = 0x0403;
    public const FRONT = 0x0404;
    public const BACK = 0x0405;
    public const LEFT = 0x0406;
    public const RIGHT = 0x0407;
    public const FRONT_AND_BACK = 0x0408;
    public const NO_ERROR = 0;
    public const INVALID_ENUM = 0x0500;
    public const INVALID_VALUE = 0x0501;
    public const INVALID_OPERATION = 0x0502;
    public const OUT_OF_MEMORY = 0x0505;
    public const CW = 0x0900;
    public const CCW = 0x0901;
    public const POINT_SIZE = 0x0B11;
    public const POINT_SIZE_RANGE = 0x0B12;
    public const POINT_SIZE_GRANULARITY = 0x0B13;
    public const LINE_SMOOTH = 0x0B20;
    public const LINE_WIDTH = 0x0B21;
    public const LINE_WIDTH_RANGE = 0x0B22;
    public const LINE_WIDTH_GRANULARITY = 0x0B23;
    public const POLYGON_MODE = 0x0B40;
    public const POLYGON_SMOOTH = 0x0B41;
    public const CULL_FACE = 0x0B44;
    public const CULL_FACE_MODE = 0x0B45;
    public const FRONT_FACE = 0x0B46;
    public const DEPTH_RANGE = 0x0B70;
    public const DEPTH_TEST = 0x0B71;
    public const DEPTH_WRITEMASK = 0x0B72;
    public const DEPTH_CLEAR_VALUE = 0x0B73;
    public const DEPTH_FUNC = 0x0B74;
    public const STENCIL_TEST = 0x0B90;
    public const STENCIL_CLEAR_VALUE = 0x0B91;
    public const STENCIL_FUNC = 0x0B92;
    public const STENCIL_VALUE_MASK = 0x0B93;
    public const STENCIL_FAIL = 0x0B94;
    public const STENCIL_PASS_DEPTH_FAIL = 0x0B95;
    public const STENCIL_PASS_DEPTH_PASS = 0x0B96;
    public const STENCIL_REF = 0x0B97;
    public const STENCIL_WRITEMASK = 0x0B98;
    public const VIEWPORT = 0x0BA2;
    public const DITHER = 0x0BD0;
    public const BLEND_DST = 0x0BE0;
    public const BLEND_SRC = 0x0BE1;
    public const BLEND = 0x0BE2;
    public const LOGIC_OP_MODE = 0x0BF0;
    public const DRAW_BUFFER = 0x0C01;
    public const READ_BUFFER = 0x0C02;
    public const SCISSOR_BOX = 0x0C10;
    public const SCISSOR_TEST = 0x0C11;
    public const COLOR_CLEAR_VALUE = 0x0C22;
    public const COLOR_WRITEMASK = 0x0C23;
    public const DOUBLEBUFFER = 0x0C32;
    public const STEREO = 0x0C33;
    public const LINE_SMOOTH_HINT = 0x0C52;
    public const POLYGON_SMOOTH_HINT = 0x0C53;
    public const UNPACK_SWAP_BYTES = 0x0CF0;
    public const UNPACK_LSB_FIRST = 0x0CF1;
    public const UNPACK_ROW_LENGTH = 0x0CF2;
    public const UNPACK_SKIP_ROWS = 0x0CF3;
    public const UNPACK_SKIP_PIXELS = 0x0CF4;
    public const UNPACK_ALIGNMENT = 0x0CF5;
    public const PACK_SWAP_BYTES = 0x0D00;
    public const PACK_LSB_FIRST = 0x0D01;
    public const PACK_ROW_LENGTH = 0x0D02;
    public const PACK_SKIP_ROWS = 0x0D03;
    public const PACK_SKIP_PIXELS = 0x0D04;
    public const PACK_ALIGNMENT = 0x0D05;
    public const MAX_TEXTURE_SIZE = 0x0D33;
    public const MAX_VIEWPORT_DIMS = 0x0D3A;
    public const SUBPIXEL_BITS = 0x0D50;
    public const TEXTURE_1D = 0x0DE0;
    public const TEXTURE_2D = 0x0DE1;
    public const TEXTURE_WIDTH = 0x1000;
    public const TEXTURE_HEIGHT = 0x1001;
    public const TEXTURE_BORDER_COLOR = 0x1004;
    public const DONT_CARE = 0x1100;
    public const FASTEST = 0x1101;
    public const NICEST = 0x1102;
    public const BYTE = 0x1400;
    public const UNSIGNED_BYTE = 0x1401;
    public const SHORT = 0x1402;
    public const UNSIGNED_SHORT = 0x1403;
    public const INT = 0x1404;
    public const UNSIGNED_INT = 0x1405;
    public const FLOAT = 0x1406;
    public const STACK_OVERFLOW = 0x0503;
    public const STACK_UNDERFLOW = 0x0504;
    public const CLEAR = 0x1500;
    public const AND = 0x1501;
    public const AND_REVERSE = 0x1502;
    public const COPY = 0x1503;
    public const AND_INVERTED = 0x1504;
    public const NOOP = 0x1505;
    public const XOR = 0x1506;
    public const OR = 0x1507;
    public const NOR = 0x1508;
    public const EQUIV = 0x1509;
    public const INVERT = 0x150A;
    public const OR_REVERSE = 0x150B;
    public const COPY_INVERTED = 0x150C;
    public const OR_INVERTED = 0x150D;
    public const NAND = 0x150E;
    public const SET = 0x150F;
    public const TEXTURE = 0x1702;
    public const COLOR = 0x1800;
    public const DEPTH = 0x1801;
    public const STENCIL = 0x1802;
    public const STENCIL_INDEX = 0x1901;
    public const DEPTH_COMPONENT = 0x1902;
    public const RED = 0x1903;
    public const GREEN = 0x1904;
    public const BLUE = 0x1905;
    public const ALPHA = 0x1906;
    public const RGB = 0x1907;
    public const RGBA = 0x1908;
    public const POINT = 0x1B00;
    public const LINE = 0x1B01;
    public const FILL = 0x1B02;
    public const KEEP = 0x1E00;
    public const REPLACE = 0x1E01;
    public const INCR = 0x1E02;
    public const DECR = 0x1E03;
    public const VENDOR = 0x1F00;
    public const RENDERER = 0x1F01;
    public const VERSION = 0x1F02;
    public const EXTENSIONS = 0x1F03;
    public const NEAREST = 0x2600;
    public const LINEAR = 0x2601;
    public const NEAREST_MIPMAP_NEAREST = 0x2700;
    public const LINEAR_MIPMAP_NEAREST = 0x2701;
    public const NEAREST_MIPMAP_LINEAR = 0x2702;
    public const LINEAR_MIPMAP_LINEAR = 0x2703;
    public const TEXTURE_MAG_FILTER = 0x2800;
    public const TEXTURE_MIN_FILTER = 0x2801;
    public const TEXTURE_WRAP_S = 0x2802;
    public const TEXTURE_WRAP_T = 0x2803;
    public const REPEAT = 0x2901;
    public const COLOR_LOGIC_OP = 0x0BF2;
    public const POLYGON_OFFSET_UNITS = 0x2A00;
    public const POLYGON_OFFSET_POINT = 0x2A01;
    public const POLYGON_OFFSET_LINE = 0x2A02;
    public const POLYGON_OFFSET_FILL = 0x8037;
    public const POLYGON_OFFSET_FACTOR = 0x8038;
    public const TEXTURE_BINDING_1D = 0x8068;
    public const TEXTURE_BINDING_2D = 0x8069;
    public const TEXTURE_INTERNAL_FORMAT = 0x1003;
    public const TEXTURE_RED_SIZE = 0x805C;
    public const TEXTURE_GREEN_SIZE = 0x805D;
    public const TEXTURE_BLUE_SIZE = 0x805E;
    public const TEXTURE_ALPHA_SIZE = 0x805F;
    public const DOUBLE = 0x140A;
    public const PROXY_TEXTURE_1D = 0x8063;
    public const PROXY_TEXTURE_2D = 0x8064;
    public const R3_G3_B2 = 0x2A10;
    public const RGB4 = 0x804F;
    public const RGB5 = 0x8050;
    public const RGB8 = 0x8051;
    public const RGB10 = 0x8052;
    public const RGB12 = 0x8053;
    public const RGB16 = 0x8054;
    public const RGBA2 = 0x8055;
    public const RGBA4 = 0x8056;
    public const RGB5_A1 = 0x8057;
    public const RGBA8 = 0x8058;
    public const RGB10_A2 = 0x8059;
    public const RGBA12 = 0x805A;
    public const RGBA16 = 0x805B;
    public const VERTEX_ARRAY = 0x8074;
    public const UNSIGNED_BYTE_3_3_2 = 0x8032;
    public const UNSIGNED_SHORT_4_4_4_4 = 0x8033;
    public const UNSIGNED_SHORT_5_5_5_1 = 0x8034;
    public const UNSIGNED_INT_8_8_8_8 = 0x8035;
    public const UNSIGNED_INT_10_10_10_2 = 0x8036;
    public const TEXTURE_BINDING_3D = 0x806A;
    public const PACK_SKIP_IMAGES = 0x806B;
    public const PACK_IMAGE_HEIGHT = 0x806C;
    public const UNPACK_SKIP_IMAGES = 0x806D;
    public const UNPACK_IMAGE_HEIGHT = 0x806E;
    public const TEXTURE_3D = 0x806F;
    public const PROXY_TEXTURE_3D = 0x8070;
    public const TEXTURE_DEPTH = 0x8071;
    public const TEXTURE_WRAP_R = 0x8072;
    public const MAX_3D_TEXTURE_SIZE = 0x8073;
    public const UNSIGNED_BYTE_2_3_3_REV = 0x8362;
    public const UNSIGNED_SHORT_5_6_5 = 0x8363;
    public const UNSIGNED_SHORT_5_6_5_REV = 0x8364;
    public const UNSIGNED_SHORT_4_4_4_4_REV = 0x8365;
    public const UNSIGNED_SHORT_1_5_5_5_REV = 0x8366;
    public const UNSIGNED_INT_8_8_8_8_REV = 0x8367;
    public const UNSIGNED_INT_2_10_10_10_REV = 0x8368;
    public const BGR = 0x80E0;
    public const BGRA = 0x80E1;
    public const MAX_ELEMENTS_VERTICES = 0x80E8;
    public const MAX_ELEMENTS_INDICES = 0x80E9;
    public const CLAMP_TO_EDGE = 0x812F;
    public const TEXTURE_MIN_LOD = 0x813A;
    public const TEXTURE_MAX_LOD = 0x813B;
    public const TEXTURE_BASE_LEVEL = 0x813C;
    public const TEXTURE_MAX_LEVEL = 0x813D;
    public const SMOOTH_POINT_SIZE_RANGE = 0x0B12;
    public const SMOOTH_POINT_SIZE_GRANULARITY = 0x0B13;
    public const SMOOTH_LINE_WIDTH_RANGE = 0x0B22;
    public const SMOOTH_LINE_WIDTH_GRANULARITY = 0x0B23;
    public const ALIASED_LINE_WIDTH_RANGE = 0x846E;
    public const TEXTURE0 = 0x84C0;
    public const TEXTURE1 = 0x84C1;
    public const TEXTURE2 = 0x84C2;
    public const TEXTURE3 = 0x84C3;
    public const TEXTURE4 = 0x84C4;
    public const TEXTURE5 = 0x84C5;
    public const TEXTURE6 = 0x84C6;
    public const TEXTURE7 = 0x84C7;
    public const TEXTURE8 = 0x84C8;
    public const TEXTURE9 = 0x84C9;
    public const TEXTURE10 = 0x84CA;
    public const TEXTURE11 = 0x84CB;
    public const TEXTURE12 = 0x84CC;
    public const TEXTURE13 = 0x84CD;
    public const TEXTURE14 = 0x84CE;
    public const TEXTURE15 = 0x84CF;
    public const TEXTURE16 = 0x84D0;
    public const TEXTURE17 = 0x84D1;
    public const TEXTURE18 = 0x84D2;
    public const TEXTURE19 = 0x84D3;
    public const TEXTURE20 = 0x84D4;
    public const TEXTURE21 = 0x84D5;
    public const TEXTURE22 = 0x84D6;
    public const TEXTURE23 = 0x84D7;
    public const TEXTURE24 = 0x84D8;
    public const TEXTURE25 = 0x84D9;
    public const TEXTURE26 = 0x84DA;
    public const TEXTURE27 = 0x84DB;
    public const TEXTURE28 = 0x84DC;
    public const TEXTURE29 = 0x84DD;
    public const TEXTURE30 = 0x84DE;
    public const TEXTURE31 = 0x84DF;
    public const ACTIVE_TEXTURE = 0x84E0;
    public const MULTISAMPLE = 0x809D;
    public const SAMPLE_ALPHA_TO_COVERAGE = 0x809E;
    public const SAMPLE_ALPHA_TO_ONE = 0x809F;
    public const SAMPLE_COVERAGE = 0x80A0;
    public const SAMPLE_BUFFERS = 0x80A8;
    public const SAMPLES = 0x80A9;
    public const SAMPLE_COVERAGE_VALUE = 0x80AA;
    public const SAMPLE_COVERAGE_INVERT = 0x80AB;
    public const TEXTURE_CUBE_MAP = 0x8513;
    public const TEXTURE_BINDING_CUBE_MAP = 0x8514;
    public const TEXTURE_CUBE_MAP_POSITIVE_X = 0x8515;
    public const TEXTURE_CUBE_MAP_NEGATIVE_X = 0x8516;
    public const TEXTURE_CUBE_MAP_POSITIVE_Y = 0x8517;
    public const TEXTURE_CUBE_MAP_NEGATIVE_Y = 0x8518;
    public const TEXTURE_CUBE_MAP_POSITIVE_Z = 0x8519;
    public const TEXTURE_CUBE_MAP_NEGATIVE_Z = 0x851A;
    public const PROXY_TEXTURE_CUBE_MAP = 0x851B;
    public const MAX_CUBE_MAP_TEXTURE_SIZE = 0x851C;
    public const COMPRESSED_RGB = 0x84ED;
    public const COMPRESSED_RGBA = 0x84EE;
    public const TEXTURE_COMPRESSION_HINT = 0x84EF;
    public const TEXTURE_COMPRESSED_IMAGE_SIZE = 0x86A0;
    public const TEXTURE_COMPRESSED = 0x86A1;
    public const NUM_COMPRESSED_TEXTURE_FORMATS = 0x86A2;
    public const COMPRESSED_TEXTURE_FORMATS = 0x86A3;
    public const CLAMP_TO_BORDER = 0x812D;
    public const BLEND_DST_RGB = 0x80C8;
    public const BLEND_SRC_RGB = 0x80C9;
    public const BLEND_DST_ALPHA = 0x80CA;
    public const BLEND_SRC_ALPHA = 0x80CB;
    public const POINT_FADE_THRESHOLD_SIZE = 0x8128;
    public const DEPTH_COMPONENT16 = 0x81A5;
    public const DEPTH_COMPONENT24 = 0x81A6;
    public const DEPTH_COMPONENT32 = 0x81A7;
    public const MIRRORED_REPEAT = 0x8370;
    public const MAX_TEXTURE_LOD_BIAS = 0x84FD;
    public const TEXTURE_LOD_BIAS = 0x8501;
    public const INCR_WRAP = 0x8507;
    public const DECR_WRAP = 0x8508;
    public const TEXTURE_DEPTH_SIZE = 0x884A;
    public const TEXTURE_COMPARE_MODE = 0x884C;
    public const TEXTURE_COMPARE_FUNC = 0x884D;
    public const BLEND_COLOR = 0x8005;
    public const BLEND_EQUATION = 0x8009;
    public const CONSTANT_COLOR = 0x8001;
    public const ONE_MINUS_CONSTANT_COLOR = 0x8002;
    public const CONSTANT_ALPHA = 0x8003;
    public const ONE_MINUS_CONSTANT_ALPHA = 0x8004;
    public const FUNC_ADD = 0x8006;
    public const FUNC_REVERSE_SUBTRACT = 0x800B;
    public const FUNC_SUBTRACT = 0x800A;
    public const MIN = 0x8007;
    public const MAX = 0x8008;
    public const BUFFER_SIZE = 0x8764;
    public const BUFFER_USAGE = 0x8765;
    public const QUERY_COUNTER_BITS = 0x8864;
    public const CURRENT_QUERY = 0x8865;
    public const QUERY_RESULT = 0x8866;
    public const QUERY_RESULT_AVAILABLE = 0x8867;
    public const ARRAY_BUFFER = 0x8892;
    public const ELEMENT_ARRAY_BUFFER = 0x8893;
    public const ARRAY_BUFFER_BINDING = 0x8894;
    public const ELEMENT_ARRAY_BUFFER_BINDING = 0x8895;
    public const VERTEX_ATTRIB_ARRAY_BUFFER_BINDING = 0x889F;
    public const READ_ONLY = 0x88B8;
    public const WRITE_ONLY = 0x88B9;
    public const READ_WRITE = 0x88BA;
    public const BUFFER_ACCESS = 0x88BB;
    public const BUFFER_MAPPED = 0x88BC;
    public const BUFFER_MAP_POINTER = 0x88BD;
    public const STREAM_DRAW = 0x88E0;
    public const STREAM_READ = 0x88E1;
    public const STREAM_COPY = 0x88E2;
    public const STATIC_DRAW = 0x88E4;
    public const STATIC_READ = 0x88E5;
    public const STATIC_COPY = 0x88E6;
    public const DYNAMIC_DRAW = 0x88E8;
    public const DYNAMIC_READ = 0x88E9;
    public const DYNAMIC_COPY = 0x88EA;
    public const SAMPLES_PASSED = 0x8914;
    public const SRC1_ALPHA = 0x8589;
    public const BLEND_EQUATION_RGB = 0x8009;
    public const VERTEX_ATTRIB_ARRAY_ENABLED = 0x8622;
    public const VERTEX_ATTRIB_ARRAY_SIZE = 0x8623;
    public const VERTEX_ATTRIB_ARRAY_STRIDE = 0x8624;
    public const VERTEX_ATTRIB_ARRAY_TYPE = 0x8625;
    public const CURRENT_VERTEX_ATTRIB = 0x8626;
    public const VERTEX_PROGRAM_POINT_SIZE = 0x8642;
    public const VERTEX_ATTRIB_ARRAY_POINTER = 0x8645;
    public const STENCIL_BACK_FUNC = 0x8800;
    public const STENCIL_BACK_FAIL = 0x8801;
    public const STENCIL_BACK_PASS_DEPTH_FAIL = 0x8802;
    public const STENCIL_BACK_PASS_DEPTH_PASS = 0x8803;
    public const MAX_DRAW_BUFFERS = 0x8824;
    public const DRAW_BUFFER0 = 0x8825;
    public const DRAW_BUFFER1 = 0x8826;
    public const DRAW_BUFFER2 = 0x8827;
    public const DRAW_BUFFER3 = 0x8828;
    public const DRAW_BUFFER4 = 0x8829;
    public const DRAW_BUFFER5 = 0x882A;
    public const DRAW_BUFFER6 = 0x882B;
    public const DRAW_BUFFER7 = 0x882C;
    public const DRAW_BUFFER8 = 0x882D;
    public const DRAW_BUFFER9 = 0x882E;
    public const DRAW_BUFFER10 = 0x882F;
    public const DRAW_BUFFER11 = 0x8830;
    public const DRAW_BUFFER12 = 0x8831;
    public const DRAW_BUFFER13 = 0x8832;
    public const DRAW_BUFFER14 = 0x8833;
    public const DRAW_BUFFER15 = 0x8834;
    public const BLEND_EQUATION_ALPHA = 0x883D;
    public const MAX_VERTEX_ATTRIBS = 0x8869;
    public const VERTEX_ATTRIB_ARRAY_NORMALIZED = 0x886A;
    public const MAX_TEXTURE_IMAGE_UNITS = 0x8872;
    public const FRAGMENT_SHADER = 0x8B30;
    public const VERTEX_SHADER = 0x8B31;
    public const MAX_FRAGMENT_UNIFORM_COMPONENTS = 0x8B49;
    public const MAX_VERTEX_UNIFORM_COMPONENTS = 0x8B4A;
    public const MAX_VARYING_FLOATS = 0x8B4B;
    public const MAX_VERTEX_TEXTURE_IMAGE_UNITS = 0x8B4C;
    public const MAX_COMBINED_TEXTURE_IMAGE_UNITS = 0x8B4D;
    public const SHADER_TYPE = 0x8B4F;
    public const FLOAT_VEC2 = 0x8B50;
    public const FLOAT_VEC3 = 0x8B51;
    public const FLOAT_VEC4 = 0x8B52;
    public const INT_VEC2 = 0x8B53;
    public const INT_VEC3 = 0x8B54;
    public const INT_VEC4 = 0x8B55;
    public const BOOL = 0x8B56;
    public const BOOL_VEC2 = 0x8B57;
    public const BOOL_VEC3 = 0x8B58;
    public const BOOL_VEC4 = 0x8B59;
    public const FLOAT_MAT2 = 0x8B5A;
    public const FLOAT_MAT3 = 0x8B5B;
    public const FLOAT_MAT4 = 0x8B5C;
    public const SAMPLER_1D = 0x8B5D;
    public const SAMPLER_2D = 0x8B5E;
    public const SAMPLER_3D = 0x8B5F;
    public const SAMPLER_CUBE = 0x8B60;
    public const SAMPLER_1D_SHADOW = 0x8B61;
    public const SAMPLER_2D_SHADOW = 0x8B62;
    public const DELETE_STATUS = 0x8B80;
    public const COMPILE_STATUS = 0x8B81;
    public const LINK_STATUS = 0x8B82;
    public const VALIDATE_STATUS = 0x8B83;
    public const INFO_LOG_LENGTH = 0x8B84;
    public const ATTACHED_SHADERS = 0x8B85;
    public const ACTIVE_UNIFORMS = 0x8B86;
    public const ACTIVE_UNIFORM_MAX_LENGTH = 0x8B87;
    public const SHADER_SOURCE_LENGTH = 0x8B88;
    public const ACTIVE_ATTRIBUTES = 0x8B89;
    public const ACTIVE_ATTRIBUTE_MAX_LENGTH = 0x8B8A;
    public const FRAGMENT_SHADER_DERIVATIVE_HINT = 0x8B8B;
    public const SHADING_LANGUAGE_VERSION = 0x8B8C;
    public const CURRENT_PROGRAM = 0x8B8D;
    public const POINT_SPRITE_COORD_ORIGIN = 0x8CA0;
    public const LOWER_LEFT = 0x8CA1;
    public const UPPER_LEFT = 0x8CA2;
    public const STENCIL_BACK_REF = 0x8CA3;
    public const STENCIL_BACK_VALUE_MASK = 0x8CA4;
    public const STENCIL_BACK_WRITEMASK = 0x8CA5;
    public const PIXEL_PACK_BUFFER = 0x88EB;
    public const PIXEL_UNPACK_BUFFER = 0x88EC;
    public const PIXEL_PACK_BUFFER_BINDING = 0x88ED;
    public const PIXEL_UNPACK_BUFFER_BINDING = 0x88EF;
    public const FLOAT_MAT2x3 = 0x8B65;
    public const FLOAT_MAT2x4 = 0x8B66;
    public const FLOAT_MAT3x2 = 0x8B67;
    public const FLOAT_MAT3x4 = 0x8B68;
    public const FLOAT_MAT4x2 = 0x8B69;
    public const FLOAT_MAT4x3 = 0x8B6A;
    public const SRGB = 0x8C40;
    public const SRGB8 = 0x8C41;
    public const SRGB_ALPHA = 0x8C42;
    public const SRGB8_ALPHA8 = 0x8C43;
    public const COMPRESSED_SRGB = 0x8C48;
    public const COMPRESSED_SRGB_ALPHA = 0x8C49;
    public const COMPARE_REF_TO_TEXTURE = 0x884E;
    public const CLIP_DISTANCE0 = 0x3000;
    public const CLIP_DISTANCE1 = 0x3001;
    public const CLIP_DISTANCE2 = 0x3002;
    public const CLIP_DISTANCE3 = 0x3003;
    public const CLIP_DISTANCE4 = 0x3004;
    public const CLIP_DISTANCE5 = 0x3005;
    public const CLIP_DISTANCE6 = 0x3006;
    public const CLIP_DISTANCE7 = 0x3007;
    public const MAX_CLIP_DISTANCES = 0x0D32;
    public const MAJOR_VERSION = 0x821B;
    public const MINOR_VERSION = 0x821C;
    public const NUM_EXTENSIONS = 0x821D;
    public const CONTEXT_FLAGS = 0x821E;
    public const COMPRESSED_RED = 0x8225;
    public const COMPRESSED_RG = 0x8226;
    public const CONTEXT_FLAG_FORWARD_COMPATIBLE_BIT = 0x00000001;
    public const RGBA32F = 0x8814;
    public const RGB32F = 0x8815;
    public const RGBA16F = 0x881A;
    public const RGB16F = 0x881B;
    public const VERTEX_ATTRIB_ARRAY_INTEGER = 0x88FD;
    public const MAX_ARRAY_TEXTURE_LAYERS = 0x88FF;
    public const MIN_PROGRAM_TEXEL_OFFSET = 0x8904;
    public const MAX_PROGRAM_TEXEL_OFFSET = 0x8905;
    public const CLAMP_READ_COLOR = 0x891C;
    public const FIXED_ONLY = 0x891D;
    public const MAX_VARYING_COMPONENTS = 0x8B4B;
    public const TEXTURE_1D_ARRAY = 0x8C18;
    public const PROXY_TEXTURE_1D_ARRAY = 0x8C19;
    public const TEXTURE_2D_ARRAY = 0x8C1A;
    public const PROXY_TEXTURE_2D_ARRAY = 0x8C1B;
    public const TEXTURE_BINDING_1D_ARRAY = 0x8C1C;
    public const TEXTURE_BINDING_2D_ARRAY = 0x8C1D;
    public const R11F_G11F_B10F = 0x8C3A;
    public const UNSIGNED_INT_10F_11F_11F_REV = 0x8C3B;
    public const RGB9_E5 = 0x8C3D;
    public const UNSIGNED_INT_5_9_9_9_REV = 0x8C3E;
    public const TEXTURE_SHARED_SIZE = 0x8C3F;
    public const TRANSFORM_FEEDBACK_VARYING_MAX_LENGTH = 0x8C76;
    public const TRANSFORM_FEEDBACK_BUFFER_MODE = 0x8C7F;
    public const MAX_TRANSFORM_FEEDBACK_SEPARATE_COMPONENTS = 0x8C80;
    public const TRANSFORM_FEEDBACK_VARYINGS = 0x8C83;
    public const TRANSFORM_FEEDBACK_BUFFER_START = 0x8C84;
    public const TRANSFORM_FEEDBACK_BUFFER_SIZE = 0x8C85;
    public const PRIMITIVES_GENERATED = 0x8C87;
    public const TRANSFORM_FEEDBACK_PRIMITIVES_WRITTEN = 0x8C88;
    public const RASTERIZER_DISCARD = 0x8C89;
    public const MAX_TRANSFORM_FEEDBACK_INTERLEAVED_COMPONENTS = 0x8C8A;
    public const MAX_TRANSFORM_FEEDBACK_SEPARATE_ATTRIBS = 0x8C8B;
    public const INTERLEAVED_ATTRIBS = 0x8C8C;
    public const SEPARATE_ATTRIBS = 0x8C8D;
    public const TRANSFORM_FEEDBACK_BUFFER = 0x8C8E;
    public const TRANSFORM_FEEDBACK_BUFFER_BINDING = 0x8C8F;
    public const RGBA32UI = 0x8D70;
    public const RGB32UI = 0x8D71;
    public const RGBA16UI = 0x8D76;
    public const RGB16UI = 0x8D77;
    public const RGBA8UI = 0x8D7C;
    public const RGB8UI = 0x8D7D;
    public const RGBA32I = 0x8D82;
    public const RGB32I = 0x8D83;
    public const RGBA16I = 0x8D88;
    public const RGB16I = 0x8D89;
    public const RGBA8I = 0x8D8E;
    public const RGB8I = 0x8D8F;
    public const RED_INTEGER = 0x8D94;
    public const GREEN_INTEGER = 0x8D95;
    public const BLUE_INTEGER = 0x8D96;
    public const RGB_INTEGER = 0x8D98;
    public const RGBA_INTEGER = 0x8D99;
    public const BGR_INTEGER = 0x8D9A;
    public const BGRA_INTEGER = 0x8D9B;
    public const SAMPLER_1D_ARRAY = 0x8DC0;
    public const SAMPLER_2D_ARRAY = 0x8DC1;
    public const SAMPLER_1D_ARRAY_SHADOW = 0x8DC3;
    public const SAMPLER_2D_ARRAY_SHADOW = 0x8DC4;
    public const SAMPLER_CUBE_SHADOW = 0x8DC5;
    public const UNSIGNED_INT_VEC2 = 0x8DC6;
    public const UNSIGNED_INT_VEC3 = 0x8DC7;
    public const UNSIGNED_INT_VEC4 = 0x8DC8;
    public const INT_SAMPLER_1D = 0x8DC9;
    public const INT_SAMPLER_2D = 0x8DCA;
    public const INT_SAMPLER_3D = 0x8DCB;
    public const INT_SAMPLER_CUBE = 0x8DCC;
    public const INT_SAMPLER_1D_ARRAY = 0x8DCE;
    public const INT_SAMPLER_2D_ARRAY = 0x8DCF;
    public const UNSIGNED_INT_SAMPLER_1D = 0x8DD1;
    public const UNSIGNED_INT_SAMPLER_2D = 0x8DD2;
    public const UNSIGNED_INT_SAMPLER_3D = 0x8DD3;
    public const UNSIGNED_INT_SAMPLER_CUBE = 0x8DD4;
    public const UNSIGNED_INT_SAMPLER_1D_ARRAY = 0x8DD6;
    public const UNSIGNED_INT_SAMPLER_2D_ARRAY = 0x8DD7;
    public const QUERY_WAIT = 0x8E13;
    public const QUERY_NO_WAIT = 0x8E14;
    public const QUERY_BY_REGION_WAIT = 0x8E15;
    public const QUERY_BY_REGION_NO_WAIT = 0x8E16;
    public const BUFFER_ACCESS_FLAGS = 0x911F;
    public const BUFFER_MAP_LENGTH = 0x9120;
    public const BUFFER_MAP_OFFSET = 0x9121;
    public const DEPTH_COMPONENT32F = 0x8CAC;
    public const DEPTH32F_STENCIL8 = 0x8CAD;
    public const FLOAT_32_UNSIGNED_INT_24_8_REV = 0x8DAD;
    public const INVALID_FRAMEBUFFER_OPERATION = 0x0506;
    public const FRAMEBUFFER_ATTACHMENT_COLOR_ENCODING = 0x8210;
    public const FRAMEBUFFER_ATTACHMENT_COMPONENT_TYPE = 0x8211;
    public const FRAMEBUFFER_ATTACHMENT_RED_SIZE = 0x8212;
    public const FRAMEBUFFER_ATTACHMENT_GREEN_SIZE = 0x8213;
    public const FRAMEBUFFER_ATTACHMENT_BLUE_SIZE = 0x8214;
    public const FRAMEBUFFER_ATTACHMENT_ALPHA_SIZE = 0x8215;
    public const FRAMEBUFFER_ATTACHMENT_DEPTH_SIZE = 0x8216;
    public const FRAMEBUFFER_ATTACHMENT_STENCIL_SIZE = 0x8217;
    public const FRAMEBUFFER_DEFAULT = 0x8218;
    public const FRAMEBUFFER_UNDEFINED = 0x8219;
    public const DEPTH_STENCIL_ATTACHMENT = 0x821A;
    public const MAX_RENDERBUFFER_SIZE = 0x84E8;
    public const DEPTH_STENCIL = 0x84F9;
    public const UNSIGNED_INT_24_8 = 0x84FA;
    public const DEPTH24_STENCIL8 = 0x88F0;
    public const TEXTURE_STENCIL_SIZE = 0x88F1;
    public const TEXTURE_RED_TYPE = 0x8C10;
    public const TEXTURE_GREEN_TYPE = 0x8C11;
    public const TEXTURE_BLUE_TYPE = 0x8C12;
    public const TEXTURE_ALPHA_TYPE = 0x8C13;
    public const TEXTURE_DEPTH_TYPE = 0x8C16;
    public const UNSIGNED_NORMALIZED = 0x8C17;
    public const FRAMEBUFFER_BINDING = 0x8CA6;
    public const DRAW_FRAMEBUFFER_BINDING = 0x8CA6;
    public const RENDERBUFFER_BINDING = 0x8CA7;
    public const READ_FRAMEBUFFER = 0x8CA8;
    public const DRAW_FRAMEBUFFER = 0x8CA9;
    public const READ_FRAMEBUFFER_BINDING = 0x8CAA;
    public const RENDERBUFFER_SAMPLES = 0x8CAB;
    public const FRAMEBUFFER_ATTACHMENT_OBJECT_TYPE = 0x8CD0;
    public const FRAMEBUFFER_ATTACHMENT_OBJECT_NAME = 0x8CD1;
    public const FRAMEBUFFER_ATTACHMENT_TEXTURE_LEVEL = 0x8CD2;
    public const FRAMEBUFFER_ATTACHMENT_TEXTURE_CUBE_MAP_FACE = 0x8CD3;
    public const FRAMEBUFFER_ATTACHMENT_TEXTURE_LAYER = 0x8CD4;
    public const FRAMEBUFFER_COMPLETE = 0x8CD5;
    public const FRAMEBUFFER_INCOMPLETE_ATTACHMENT = 0x8CD6;
    public const FRAMEBUFFER_INCOMPLETE_MISSING_ATTACHMENT = 0x8CD7;
    public const FRAMEBUFFER_INCOMPLETE_DRAW_BUFFER = 0x8CDB;
    public const FRAMEBUFFER_INCOMPLETE_READ_BUFFER = 0x8CDC;
    public const FRAMEBUFFER_UNSUPPORTED = 0x8CDD;
    public const MAX_COLOR_ATTACHMENTS = 0x8CDF;
    public const COLOR_ATTACHMENT0 = 0x8CE0;
    public const COLOR_ATTACHMENT1 = 0x8CE1;
    public const COLOR_ATTACHMENT2 = 0x8CE2;
    public const COLOR_ATTACHMENT3 = 0x8CE3;
    public const COLOR_ATTACHMENT4 = 0x8CE4;
    public const COLOR_ATTACHMENT5 = 0x8CE5;
    public const COLOR_ATTACHMENT6 = 0x8CE6;
    public const COLOR_ATTACHMENT7 = 0x8CE7;
    public const COLOR_ATTACHMENT8 = 0x8CE8;
    public const COLOR_ATTACHMENT9 = 0x8CE9;
    public const COLOR_ATTACHMENT10 = 0x8CEA;
    public const COLOR_ATTACHMENT11 = 0x8CEB;
    public const COLOR_ATTACHMENT12 = 0x8CEC;
    public const COLOR_ATTACHMENT13 = 0x8CED;
    public const COLOR_ATTACHMENT14 = 0x8CEE;
    public const COLOR_ATTACHMENT15 = 0x8CEF;
    public const COLOR_ATTACHMENT16 = 0x8CF0;
    public const COLOR_ATTACHMENT17 = 0x8CF1;
    public const COLOR_ATTACHMENT18 = 0x8CF2;
    public const COLOR_ATTACHMENT19 = 0x8CF3;
    public const COLOR_ATTACHMENT20 = 0x8CF4;
    public const COLOR_ATTACHMENT21 = 0x8CF5;
    public const COLOR_ATTACHMENT22 = 0x8CF6;
    public const COLOR_ATTACHMENT23 = 0x8CF7;
    public const COLOR_ATTACHMENT24 = 0x8CF8;
    public const COLOR_ATTACHMENT25 = 0x8CF9;
    public const COLOR_ATTACHMENT26 = 0x8CFA;
    public const COLOR_ATTACHMENT27 = 0x8CFB;
    public const COLOR_ATTACHMENT28 = 0x8CFC;
    public const COLOR_ATTACHMENT29 = 0x8CFD;
    public const COLOR_ATTACHMENT30 = 0x8CFE;
    public const COLOR_ATTACHMENT31 = 0x8CFF;
    public const DEPTH_ATTACHMENT = 0x8D00;
    public const STENCIL_ATTACHMENT = 0x8D20;
    public const FRAMEBUFFER = 0x8D40;
    public const RENDERBUFFER = 0x8D41;
    public const RENDERBUFFER_WIDTH = 0x8D42;
    public const RENDERBUFFER_HEIGHT = 0x8D43;
    public const RENDERBUFFER_INTERNAL_FORMAT = 0x8D44;
    public const STENCIL_INDEX1 = 0x8D46;
    public const STENCIL_INDEX4 = 0x8D47;
    public const STENCIL_INDEX8 = 0x8D48;
    public const STENCIL_INDEX16 = 0x8D49;
    public const RENDERBUFFER_RED_SIZE = 0x8D50;
    public const RENDERBUFFER_GREEN_SIZE = 0x8D51;
    public const RENDERBUFFER_BLUE_SIZE = 0x8D52;
    public const RENDERBUFFER_ALPHA_SIZE = 0x8D53;
    public const RENDERBUFFER_DEPTH_SIZE = 0x8D54;
    public const RENDERBUFFER_STENCIL_SIZE = 0x8D55;
    public const FRAMEBUFFER_INCOMPLETE_MULTISAMPLE = 0x8D56;
    public const MAX_SAMPLES = 0x8D57;
    public const FRAMEBUFFER_SRGB = 0x8DB9;
    public const HALF_FLOAT = 0x140B;
    public const MAP_READ_BIT = 0x0001;
    public const MAP_WRITE_BIT = 0x0002;
    public const MAP_INVALIDATE_RANGE_BIT = 0x0004;
    public const MAP_INVALIDATE_BUFFER_BIT = 0x0008;
    public const MAP_FLUSH_EXPLICIT_BIT = 0x0010;
    public const MAP_UNSYNCHRONIZED_BIT = 0x0020;
    public const COMPRESSED_RED_RGTC1 = 0x8DBB;
    public const COMPRESSED_SIGNED_RED_RGTC1 = 0x8DBC;
    public const COMPRESSED_RG_RGTC2 = 0x8DBD;
    public const COMPRESSED_SIGNED_RG_RGTC2 = 0x8DBE;
    public const RG = 0x8227;
    public const RG_INTEGER = 0x8228;
    public const R8 = 0x8229;
    public const R16 = 0x822A;
    public const RG8 = 0x822B;
    public const RG16 = 0x822C;
    public const R16F = 0x822D;
    public const R32F = 0x822E;
    public const RG16F = 0x822F;
    public const RG32F = 0x8230;
    public const R8I = 0x8231;
    public const R8UI = 0x8232;
    public const R16I = 0x8233;
    public const R16UI = 0x8234;
    public const R32I = 0x8235;
    public const R32UI = 0x8236;
    public const RG8I = 0x8237;
    public const RG8UI = 0x8238;
    public const RG16I = 0x8239;
    public const RG16UI = 0x823A;
    public const RG32I = 0x823B;
    public const RG32UI = 0x823C;
    public const VERTEX_ARRAY_BINDING = 0x85B5;
    public const SAMPLER_2D_RECT = 0x8B63;
    public const SAMPLER_2D_RECT_SHADOW = 0x8B64;
    public const SAMPLER_BUFFER = 0x8DC2;
    public const INT_SAMPLER_2D_RECT = 0x8DCD;
    public const INT_SAMPLER_BUFFER = 0x8DD0;
    public const UNSIGNED_INT_SAMPLER_2D_RECT = 0x8DD5;
    public const UNSIGNED_INT_SAMPLER_BUFFER = 0x8DD8;
    public const TEXTURE_BUFFER = 0x8C2A;
    public const MAX_TEXTURE_BUFFER_SIZE = 0x8C2B;
    public const TEXTURE_BINDING_BUFFER = 0x8C2C;
    public const TEXTURE_BUFFER_DATA_STORE_BINDING = 0x8C2D;
    public const TEXTURE_RECTANGLE = 0x84F5;
    public const TEXTURE_BINDING_RECTANGLE = 0x84F6;
    public const PROXY_TEXTURE_RECTANGLE = 0x84F7;
    public const MAX_RECTANGLE_TEXTURE_SIZE = 0x84F8;
    public const R8_SNORM = 0x8F94;
    public const RG8_SNORM = 0x8F95;
    public const RGB8_SNORM = 0x8F96;
    public const RGBA8_SNORM = 0x8F97;
    public const R16_SNORM = 0x8F98;
    public const RG16_SNORM = 0x8F99;
    public const RGB16_SNORM = 0x8F9A;
    public const RGBA16_SNORM = 0x8F9B;
    public const SIGNED_NORMALIZED = 0x8F9C;
    public const PRIMITIVE_RESTART = 0x8F9D;
    public const PRIMITIVE_RESTART_INDEX = 0x8F9E;
    public const COPY_READ_BUFFER = 0x8F36;
    public const COPY_WRITE_BUFFER = 0x8F37;
    public const UNIFORM_BUFFER = 0x8A11;
    public const UNIFORM_BUFFER_BINDING = 0x8A28;
    public const UNIFORM_BUFFER_START = 0x8A29;
    public const UNIFORM_BUFFER_SIZE = 0x8A2A;
    public const MAX_VERTEX_UNIFORM_BLOCKS = 0x8A2B;
    public const MAX_GEOMETRY_UNIFORM_BLOCKS = 0x8A2C;
    public const MAX_FRAGMENT_UNIFORM_BLOCKS = 0x8A2D;
    public const MAX_COMBINED_UNIFORM_BLOCKS = 0x8A2E;
    public const MAX_UNIFORM_BUFFER_BINDINGS = 0x8A2F;
    public const MAX_UNIFORM_BLOCK_SIZE = 0x8A30;
    public const MAX_COMBINED_VERTEX_UNIFORM_COMPONENTS = 0x8A31;
    public const MAX_COMBINED_GEOMETRY_UNIFORM_COMPONENTS = 0x8A32;
    public const MAX_COMBINED_FRAGMENT_UNIFORM_COMPONENTS = 0x8A33;
    public const UNIFORM_BUFFER_OFFSET_ALIGNMENT = 0x8A34;
    public const ACTIVE_UNIFORM_BLOCK_MAX_NAME_LENGTH = 0x8A35;
    public const ACTIVE_UNIFORM_BLOCKS = 0x8A36;
    public const UNIFORM_TYPE = 0x8A37;
    public const UNIFORM_SIZE = 0x8A38;
    public const UNIFORM_NAME_LENGTH = 0x8A39;
    public const UNIFORM_BLOCK_INDEX = 0x8A3A;
    public const UNIFORM_OFFSET = 0x8A3B;
    public const UNIFORM_ARRAY_STRIDE = 0x8A3C;
    public const UNIFORM_MATRIX_STRIDE = 0x8A3D;
    public const UNIFORM_IS_ROW_MAJOR = 0x8A3E;
    public const UNIFORM_BLOCK_BINDING = 0x8A3F;
    public const UNIFORM_BLOCK_DATA_SIZE = 0x8A40;
    public const UNIFORM_BLOCK_NAME_LENGTH = 0x8A41;
    public const UNIFORM_BLOCK_ACTIVE_UNIFORMS = 0x8A42;
    public const UNIFORM_BLOCK_ACTIVE_UNIFORM_INDICES = 0x8A43;
    public const UNIFORM_BLOCK_REFERENCED_BY_VERTEX_SHADER = 0x8A44;
    public const UNIFORM_BLOCK_REFERENCED_BY_GEOMETRY_SHADER = 0x8A45;
    public const UNIFORM_BLOCK_REFERENCED_BY_FRAGMENT_SHADER = 0x8A46;
    public const INVALID_INDEX = 0xFFFFFFFF;
    public const CONTEXT_CORE_PROFILE_BIT = 0x00000001;
    public const CONTEXT_COMPATIBILITY_PROFILE_BIT = 0x00000002;
    public const LINES_ADJACENCY = 0x000A;
    public const LINE_STRIP_ADJACENCY = 0x000B;
    public const TRIANGLES_ADJACENCY = 0x000C;
    public const TRIANGLE_STRIP_ADJACENCY = 0x000D;
    public const PROGRAM_POINT_SIZE = 0x8642;
    public const MAX_GEOMETRY_TEXTURE_IMAGE_UNITS = 0x8C29;
    public const FRAMEBUFFER_ATTACHMENT_LAYERED = 0x8DA7;
    public const FRAMEBUFFER_INCOMPLETE_LAYER_TARGETS = 0x8DA8;
    public const GEOMETRY_SHADER = 0x8DD9;
    public const GEOMETRY_VERTICES_OUT = 0x8916;
    public const GEOMETRY_INPUT_TYPE = 0x8917;
    public const GEOMETRY_OUTPUT_TYPE = 0x8918;
    public const MAX_GEOMETRY_UNIFORM_COMPONENTS = 0x8DDF;
    public const MAX_GEOMETRY_OUTPUT_VERTICES = 0x8DE0;
    public const MAX_GEOMETRY_TOTAL_OUTPUT_COMPONENTS = 0x8DE1;
    public const MAX_VERTEX_OUTPUT_COMPONENTS = 0x9122;
    public const MAX_GEOMETRY_INPUT_COMPONENTS = 0x9123;
    public const MAX_GEOMETRY_OUTPUT_COMPONENTS = 0x9124;
    public const MAX_FRAGMENT_INPUT_COMPONENTS = 0x9125;
    public const CONTEXT_PROFILE_MASK = 0x9126;
    public const DEPTH_CLAMP = 0x864F;
    public const QUADS_FOLLOW_PROVOKING_VERTEX_CONVENTION = 0x8E4C;
    public const FIRST_VERTEX_CONVENTION = 0x8E4D;
    public const LAST_VERTEX_CONVENTION = 0x8E4E;
    public const PROVOKING_VERTEX = 0x8E4F;
    public const TEXTURE_CUBE_MAP_SEAMLESS = 0x884F;
    public const MAX_SERVER_WAIT_TIMEOUT = 0x9111;
    public const OBJECT_TYPE = 0x9112;
    public const SYNC_CONDITION = 0x9113;
    public const SYNC_STATUS = 0x9114;
    public const SYNC_FLAGS = 0x9115;
    public const SYNC_FENCE = 0x9116;
    public const SYNC_GPU_COMMANDS_COMPLETE = 0x9117;
    public const UNSIGNALED = 0x9118;
    public const SIGNALED = 0x9119;
    public const ALREADY_SIGNALED = 0x911A;
    public const TIMEOUT_EXPIRED = 0x911B;
    public const CONDITION_SATISFIED = 0x911C;
    public const WAIT_FAILED = 0x911D;
    public const TIMEOUT_IGNORED = 0xFFFFFFFFFFFFFFFF;
    public const SYNC_FLUSH_COMMANDS_BIT = 0x00000001;
    public const SAMPLE_POSITION = 0x8E50;
    public const SAMPLE_MASK = 0x8E51;
    public const SAMPLE_MASK_VALUE = 0x8E52;
    public const MAX_SAMPLE_MASK_WORDS = 0x8E59;
    public const TEXTURE_2D_MULTISAMPLE = 0x9100;
    public const PROXY_TEXTURE_2D_MULTISAMPLE = 0x9101;
    public const TEXTURE_2D_MULTISAMPLE_ARRAY = 0x9102;
    public const PROXY_TEXTURE_2D_MULTISAMPLE_ARRAY = 0x9103;
    public const TEXTURE_BINDING_2D_MULTISAMPLE = 0x9104;
    public const TEXTURE_BINDING_2D_MULTISAMPLE_ARRAY = 0x9105;
    public const TEXTURE_SAMPLES = 0x9106;
    public const TEXTURE_FIXED_SAMPLE_LOCATIONS = 0x9107;
    public const SAMPLER_2D_MULTISAMPLE = 0x9108;
    public const INT_SAMPLER_2D_MULTISAMPLE = 0x9109;
    public const UNSIGNED_INT_SAMPLER_2D_MULTISAMPLE = 0x910A;
    public const SAMPLER_2D_MULTISAMPLE_ARRAY = 0x910B;
    public const INT_SAMPLER_2D_MULTISAMPLE_ARRAY = 0x910C;
    public const UNSIGNED_INT_SAMPLER_2D_MULTISAMPLE_ARRAY = 0x910D;
    public const MAX_COLOR_TEXTURE_SAMPLES = 0x910E;
    public const MAX_DEPTH_TEXTURE_SAMPLES = 0x910F;
    public const MAX_INTEGER_SAMPLES = 0x9110;
    public const VERTEX_ATTRIB_ARRAY_DIVISOR = 0x88FE;
    public const SRC1_COLOR = 0x88F9;
    public const ONE_MINUS_SRC1_COLOR = 0x88FA;
    public const ONE_MINUS_SRC1_ALPHA = 0x88FB;
    public const MAX_DUAL_SOURCE_DRAW_BUFFERS = 0x88FC;
    public const ANY_SAMPLES_PASSED = 0x8C2F;
    public const SAMPLER_BINDING = 0x8919;
    public const RGB10_A2UI = 0x906F;
    public const TEXTURE_SWIZZLE_R = 0x8E42;
    public const TEXTURE_SWIZZLE_G = 0x8E43;
    public const TEXTURE_SWIZZLE_B = 0x8E44;
    public const TEXTURE_SWIZZLE_A = 0x8E45;
    public const TEXTURE_SWIZZLE_RGBA = 0x8E46;
    public const TIME_ELAPSED = 0x88BF;
    public const TIMESTAMP = 0x8E28;
    public const INT_2_10_10_10_REV = 0x8D9F;
    public const SAMPLE_SHADING = 0x8C36;
    public const MIN_SAMPLE_SHADING_VALUE = 0x8C37;
    public const MIN_PROGRAM_TEXTURE_GATHER_OFFSET = 0x8E5E;
    public const MAX_PROGRAM_TEXTURE_GATHER_OFFSET = 0x8E5F;
    public const TEXTURE_CUBE_MAP_ARRAY = 0x9009;
    public const TEXTURE_BINDING_CUBE_MAP_ARRAY = 0x900A;
    public const PROXY_TEXTURE_CUBE_MAP_ARRAY = 0x900B;
    public const SAMPLER_CUBE_MAP_ARRAY = 0x900C;
    public const SAMPLER_CUBE_MAP_ARRAY_SHADOW = 0x900D;
    public const INT_SAMPLER_CUBE_MAP_ARRAY = 0x900E;
    public const UNSIGNED_INT_SAMPLER_CUBE_MAP_ARRAY = 0x900F;
    public const DRAW_INDIRECT_BUFFER = 0x8F3F;
    public const DRAW_INDIRECT_BUFFER_BINDING = 0x8F43;
    public const GEOMETRY_SHADER_INVOCATIONS = 0x887F;
    public const MAX_GEOMETRY_SHADER_INVOCATIONS = 0x8E5A;
    public const MIN_FRAGMENT_INTERPOLATION_OFFSET = 0x8E5B;
    public const MAX_FRAGMENT_INTERPOLATION_OFFSET = 0x8E5C;
    public const FRAGMENT_INTERPOLATION_OFFSET_BITS = 0x8E5D;
    public const MAX_VERTEX_STREAMS = 0x8E71;
    public const DOUBLE_VEC2 = 0x8FFC;
    public const DOUBLE_VEC3 = 0x8FFD;
    public const DOUBLE_VEC4 = 0x8FFE;
    public const DOUBLE_MAT2 = 0x8F46;
    public const DOUBLE_MAT3 = 0x8F47;
    public const DOUBLE_MAT4 = 0x8F48;
    public const DOUBLE_MAT2x3 = 0x8F49;
    public const DOUBLE_MAT2x4 = 0x8F4A;
    public const DOUBLE_MAT3x2 = 0x8F4B;
    public const DOUBLE_MAT3x4 = 0x8F4C;
    public const DOUBLE_MAT4x2 = 0x8F4D;
    public const DOUBLE_MAT4x3 = 0x8F4E;
    public const ACTIVE_SUBROUTINES = 0x8DE5;
    public const ACTIVE_SUBROUTINE_UNIFORMS = 0x8DE6;
    public const ACTIVE_SUBROUTINE_UNIFORM_LOCATIONS = 0x8E47;
    public const ACTIVE_SUBROUTINE_MAX_LENGTH = 0x8E48;
    public const ACTIVE_SUBROUTINE_UNIFORM_MAX_LENGTH = 0x8E49;
    public const MAX_SUBROUTINES = 0x8DE7;
    public const MAX_SUBROUTINE_UNIFORM_LOCATIONS = 0x8DE8;
    public const NUM_COMPATIBLE_SUBROUTINES = 0x8E4A;
    public const COMPATIBLE_SUBROUTINES = 0x8E4B;
    public const PATCHES = 0x000E;
    public const PATCH_VERTICES = 0x8E72;
    public const PATCH_DEFAULT_INNER_LEVEL = 0x8E73;
    public const PATCH_DEFAULT_OUTER_LEVEL = 0x8E74;
    public const TESS_CONTROL_OUTPUT_VERTICES = 0x8E75;
    public const TESS_GEN_MODE = 0x8E76;
    public const TESS_GEN_SPACING = 0x8E77;
    public const TESS_GEN_VERTEX_ORDER = 0x8E78;
    public const TESS_GEN_POINT_MODE = 0x8E79;
    public const ISOLINES = 0x8E7A;
    public const FRACTIONAL_ODD = 0x8E7B;
    public const FRACTIONAL_EVEN = 0x8E7C;
    public const MAX_PATCH_VERTICES = 0x8E7D;
    public const MAX_TESS_GEN_LEVEL = 0x8E7E;
    public const MAX_TESS_CONTROL_UNIFORM_COMPONENTS = 0x8E7F;
    public const MAX_TESS_EVALUATION_UNIFORM_COMPONENTS = 0x8E80;
    public const MAX_TESS_CONTROL_TEXTURE_IMAGE_UNITS = 0x8E81;
    public const MAX_TESS_EVALUATION_TEXTURE_IMAGE_UNITS = 0x8E82;
    public const MAX_TESS_CONTROL_OUTPUT_COMPONENTS = 0x8E83;
    public const MAX_TESS_PATCH_COMPONENTS = 0x8E84;
    public const MAX_TESS_CONTROL_TOTAL_OUTPUT_COMPONENTS = 0x8E85;
    public const MAX_TESS_EVALUATION_OUTPUT_COMPONENTS = 0x8E86;
    public const MAX_TESS_CONTROL_UNIFORM_BLOCKS = 0x8E89;
    public const MAX_TESS_EVALUATION_UNIFORM_BLOCKS = 0x8E8A;
    public const MAX_TESS_CONTROL_INPUT_COMPONENTS = 0x886C;
    public const MAX_TESS_EVALUATION_INPUT_COMPONENTS = 0x886D;
    public const MAX_COMBINED_TESS_CONTROL_UNIFORM_COMPONENTS = 0x8E1E;
    public const MAX_COMBINED_TESS_EVALUATION_UNIFORM_COMPONENTS = 0x8E1F;
    public const UNIFORM_BLOCK_REFERENCED_BY_TESS_CONTROL_SHADER = 0x84F0;
    public const UNIFORM_BLOCK_REFERENCED_BY_TESS_EVALUATION_SHADER = 0x84F1;
    public const TESS_EVALUATION_SHADER = 0x8E87;
    public const TESS_CONTROL_SHADER = 0x8E88;
    public const TRANSFORM_FEEDBACK = 0x8E22;
    public const TRANSFORM_FEEDBACK_BUFFER_PAUSED = 0x8E23;
    public const TRANSFORM_FEEDBACK_BUFFER_ACTIVE = 0x8E24;
    public const TRANSFORM_FEEDBACK_BINDING = 0x8E25;
    public const MAX_TRANSFORM_FEEDBACK_BUFFERS = 0x8E70;
    public const FIXED = 0x140C;
    public const IMPLEMENTATION_COLOR_READ_TYPE = 0x8B9A;
    public const IMPLEMENTATION_COLOR_READ_FORMAT = 0x8B9B;
    public const LOW_FLOAT = 0x8DF0;
    public const MEDIUM_FLOAT = 0x8DF1;
    public const HIGH_FLOAT = 0x8DF2;
    public const LOW_INT = 0x8DF3;
    public const MEDIUM_INT = 0x8DF4;
    public const HIGH_INT = 0x8DF5;
    public const SHADER_COMPILER = 0x8DFA;
    public const SHADER_BINARY_FORMATS = 0x8DF8;
    public const NUM_SHADER_BINARY_FORMATS = 0x8DF9;
    public const MAX_VERTEX_UNIFORM_VECTORS = 0x8DFB;
    public const MAX_VARYING_VECTORS = 0x8DFC;
    public const MAX_FRAGMENT_UNIFORM_VECTORS = 0x8DFD;
    public const RGB565 = 0x8D62;
    public const PROGRAM_BINARY_RETRIEVABLE_HINT = 0x8257;
    public const PROGRAM_BINARY_LENGTH = 0x8741;
    public const NUM_PROGRAM_BINARY_FORMATS = 0x87FE;
    public const PROGRAM_BINARY_FORMATS = 0x87FF;
    public const VERTEX_SHADER_BIT = 0x00000001;
    public const FRAGMENT_SHADER_BIT = 0x00000002;
    public const GEOMETRY_SHADER_BIT = 0x00000004;
    public const TESS_CONTROL_SHADER_BIT = 0x00000008;
    public const TESS_EVALUATION_SHADER_BIT = 0x00000010;
    public const ALL_SHADER_BITS = 0xFFFFFFFF;
    public const PROGRAM_SEPARABLE = 0x8258;
    public const ACTIVE_PROGRAM = 0x8259;
    public const PROGRAM_PIPELINE_BINDING = 0x825A;
    public const MAX_VIEWPORTS = 0x825B;
    public const VIEWPORT_SUBPIXEL_BITS = 0x825C;
    public const VIEWPORT_BOUNDS_RANGE = 0x825D;
    public const LAYER_PROVOKING_VERTEX = 0x825E;
    public const VIEWPORT_INDEX_PROVOKING_VERTEX = 0x825F;
    public const UNDEFINED_VERTEX = 0x8260;
    public const COPY_READ_BUFFER_BINDING = 0x8F36;
    public const COPY_WRITE_BUFFER_BINDING = 0x8F37;
    public const TRANSFORM_FEEDBACK_ACTIVE = 0x8E24;
    public const TRANSFORM_FEEDBACK_PAUSED = 0x8E23;
    public const UNPACK_COMPRESSED_BLOCK_WIDTH = 0x9127;
    public const UNPACK_COMPRESSED_BLOCK_HEIGHT = 0x9128;
    public const UNPACK_COMPRESSED_BLOCK_DEPTH = 0x9129;
    public const UNPACK_COMPRESSED_BLOCK_SIZE = 0x912A;
    public const PACK_COMPRESSED_BLOCK_WIDTH = 0x912B;
    public const PACK_COMPRESSED_BLOCK_HEIGHT = 0x912C;
    public const PACK_COMPRESSED_BLOCK_DEPTH = 0x912D;
    public const PACK_COMPRESSED_BLOCK_SIZE = 0x912E;
    public const NUM_SAMPLE_COUNTS = 0x9380;
    public const MIN_MAP_BUFFER_ALIGNMENT = 0x90BC;
    public const ATOMIC_COUNTER_BUFFER = 0x92C0;
    public const ATOMIC_COUNTER_BUFFER_BINDING = 0x92C1;
    public const ATOMIC_COUNTER_BUFFER_START = 0x92C2;
    public const ATOMIC_COUNTER_BUFFER_SIZE = 0x92C3;
    public const ATOMIC_COUNTER_BUFFER_DATA_SIZE = 0x92C4;
    public const ATOMIC_COUNTER_BUFFER_ACTIVE_ATOMIC_COUNTERS = 0x92C5;
    public const ATOMIC_COUNTER_BUFFER_ACTIVE_ATOMIC_COUNTER_INDICES = 0x92C6;
    public const ATOMIC_COUNTER_BUFFER_REFERENCED_BY_VERTEX_SHADER = 0x92C7;
    public const ATOMIC_COUNTER_BUFFER_REFERENCED_BY_TESS_CONTROL_SHADER = 0x92C8;
    public const ATOMIC_COUNTER_BUFFER_REFERENCED_BY_TESS_EVALUATION_SHADER = 0x92C9;
    public const ATOMIC_COUNTER_BUFFER_REFERENCED_BY_GEOMETRY_SHADER = 0x92CA;
    public const ATOMIC_COUNTER_BUFFER_REFERENCED_BY_FRAGMENT_SHADER = 0x92CB;
    public const MAX_VERTEX_ATOMIC_COUNTER_BUFFERS = 0x92CC;
    public const MAX_TESS_CONTROL_ATOMIC_COUNTER_BUFFERS = 0x92CD;
    public const MAX_TESS_EVALUATION_ATOMIC_COUNTER_BUFFERS = 0x92CE;
    public const MAX_GEOMETRY_ATOMIC_COUNTER_BUFFERS = 0x92CF;
    public const MAX_FRAGMENT_ATOMIC_COUNTER_BUFFERS = 0x92D0;
    public const MAX_COMBINED_ATOMIC_COUNTER_BUFFERS = 0x92D1;
    public const MAX_VERTEX_ATOMIC_COUNTERS = 0x92D2;
    public const MAX_TESS_CONTROL_ATOMIC_COUNTERS = 0x92D3;
    public const MAX_TESS_EVALUATION_ATOMIC_COUNTERS = 0x92D4;
    public const MAX_GEOMETRY_ATOMIC_COUNTERS = 0x92D5;
    public const MAX_FRAGMENT_ATOMIC_COUNTERS = 0x92D6;
    public const MAX_COMBINED_ATOMIC_COUNTERS = 0x92D7;
    public const MAX_ATOMIC_COUNTER_BUFFER_SIZE = 0x92D8;
    public const MAX_ATOMIC_COUNTER_BUFFER_BINDINGS = 0x92DC;
    public const ACTIVE_ATOMIC_COUNTER_BUFFERS = 0x92D9;
    public const UNIFORM_ATOMIC_COUNTER_BUFFER_INDEX = 0x92DA;
    public const UNSIGNED_INT_ATOMIC_COUNTER = 0x92DB;
    public const VERTEX_ATTRIB_ARRAY_BARRIER_BIT = 0x00000001;
    public const ELEMENT_ARRAY_BARRIER_BIT = 0x00000002;
    public const UNIFORM_BARRIER_BIT = 0x00000004;
    public const TEXTURE_FETCH_BARRIER_BIT = 0x00000008;
    public const SHADER_IMAGE_ACCESS_BARRIER_BIT = 0x00000020;
    public const COMMAND_BARRIER_BIT = 0x00000040;
    public const PIXEL_BUFFER_BARRIER_BIT = 0x00000080;
    public const TEXTURE_UPDATE_BARRIER_BIT = 0x00000100;
    public const BUFFER_UPDATE_BARRIER_BIT = 0x00000200;
    public const FRAMEBUFFER_BARRIER_BIT = 0x00000400;
    public const TRANSFORM_FEEDBACK_BARRIER_BIT = 0x00000800;
    public const ATOMIC_COUNTER_BARRIER_BIT = 0x00001000;
    public const ALL_BARRIER_BITS = 0xFFFFFFFF;
    public const MAX_IMAGE_UNITS = 0x8F38;
    public const MAX_COMBINED_IMAGE_UNITS_AND_FRAGMENT_OUTPUTS = 0x8F39;
    public const IMAGE_BINDING_NAME = 0x8F3A;
    public const IMAGE_BINDING_LEVEL = 0x8F3B;
    public const IMAGE_BINDING_LAYERED = 0x8F3C;
    public const IMAGE_BINDING_LAYER = 0x8F3D;
    public const IMAGE_BINDING_ACCESS = 0x8F3E;
    public const IMAGE_1D = 0x904C;
    public const IMAGE_2D = 0x904D;
    public const IMAGE_3D = 0x904E;
    public const IMAGE_2D_RECT = 0x904F;
    public const IMAGE_CUBE = 0x9050;
    public const IMAGE_BUFFER = 0x9051;
    public const IMAGE_1D_ARRAY = 0x9052;
    public const IMAGE_2D_ARRAY = 0x9053;
    public const IMAGE_CUBE_MAP_ARRAY = 0x9054;
    public const IMAGE_2D_MULTISAMPLE = 0x9055;
    public const IMAGE_2D_MULTISAMPLE_ARRAY = 0x9056;
    public const INT_IMAGE_1D = 0x9057;
    public const INT_IMAGE_2D = 0x9058;
    public const INT_IMAGE_3D = 0x9059;
    public const INT_IMAGE_2D_RECT = 0x905A;
    public const INT_IMAGE_CUBE = 0x905B;
    public const INT_IMAGE_BUFFER = 0x905C;
    public const INT_IMAGE_1D_ARRAY = 0x905D;
    public const INT_IMAGE_2D_ARRAY = 0x905E;
    public const INT_IMAGE_CUBE_MAP_ARRAY = 0x905F;
    public const INT_IMAGE_2D_MULTISAMPLE = 0x9060;
    public const INT_IMAGE_2D_MULTISAMPLE_ARRAY = 0x9061;
    public const UNSIGNED_INT_IMAGE_1D = 0x9062;
    public const UNSIGNED_INT_IMAGE_2D = 0x9063;
    public const UNSIGNED_INT_IMAGE_3D = 0x9064;
    public const UNSIGNED_INT_IMAGE_2D_RECT = 0x9065;
    public const UNSIGNED_INT_IMAGE_CUBE = 0x9066;
    public const UNSIGNED_INT_IMAGE_BUFFER = 0x9067;
    public const UNSIGNED_INT_IMAGE_1D_ARRAY = 0x9068;
    public const UNSIGNED_INT_IMAGE_2D_ARRAY = 0x9069;
    public const UNSIGNED_INT_IMAGE_CUBE_MAP_ARRAY = 0x906A;
    public const UNSIGNED_INT_IMAGE_2D_MULTISAMPLE = 0x906B;
    public const UNSIGNED_INT_IMAGE_2D_MULTISAMPLE_ARRAY = 0x906C;
    public const MAX_IMAGE_SAMPLES = 0x906D;
    public const IMAGE_BINDING_FORMAT = 0x906E;
    public const IMAGE_FORMAT_COMPATIBILITY_TYPE = 0x90C7;
    public const IMAGE_FORMAT_COMPATIBILITY_BY_SIZE = 0x90C8;
    public const IMAGE_FORMAT_COMPATIBILITY_BY_CLASS = 0x90C9;
    public const MAX_VERTEX_IMAGE_UNIFORMS = 0x90CA;
    public const MAX_TESS_CONTROL_IMAGE_UNIFORMS = 0x90CB;
    public const MAX_TESS_EVALUATION_IMAGE_UNIFORMS = 0x90CC;
    public const MAX_GEOMETRY_IMAGE_UNIFORMS = 0x90CD;
    public const MAX_FRAGMENT_IMAGE_UNIFORMS = 0x90CE;
    public const MAX_COMBINED_IMAGE_UNIFORMS = 0x90CF;
    public const COMPRESSED_RGBA_BPTC_UNORM = 0x8E8C;
    public const COMPRESSED_SRGB_ALPHA_BPTC_UNORM = 0x8E8D;
    public const COMPRESSED_RGB_BPTC_SIGNED_FLOAT = 0x8E8E;
    public const COMPRESSED_RGB_BPTC_UNSIGNED_FLOAT = 0x8E8F;
    public const TEXTURE_IMMUTABLE_FORMAT = 0x912F;
    public const NUM_SHADING_LANGUAGE_VERSIONS = 0x82E9;
    public const VERTEX_ATTRIB_ARRAY_LONG = 0x874E;
    public const COMPRESSED_RGB8_ETC2 = 0x9274;
    public const COMPRESSED_SRGB8_ETC2 = 0x9275;
    public const COMPRESSED_RGB8_PUNCHTHROUGH_ALPHA1_ETC2 = 0x9276;
    public const COMPRESSED_SRGB8_PUNCHTHROUGH_ALPHA1_ETC2 = 0x9277;
    public const COMPRESSED_RGBA8_ETC2_EAC = 0x9278;
    public const COMPRESSED_SRGB8_ALPHA8_ETC2_EAC = 0x9279;
    public const COMPRESSED_R11_EAC = 0x9270;
    public const COMPRESSED_SIGNED_R11_EAC = 0x9271;
    public const COMPRESSED_RG11_EAC = 0x9272;
    public const COMPRESSED_SIGNED_RG11_EAC = 0x9273;
    public const PRIMITIVE_RESTART_FIXED_INDEX = 0x8D69;
    public const ANY_SAMPLES_PASSED_CONSERVATIVE = 0x8D6A;
    public const MAX_ELEMENT_INDEX = 0x8D6B;
    public const COMPUTE_SHADER = 0x91B9;
    public const MAX_COMPUTE_UNIFORM_BLOCKS = 0x91BB;
    public const MAX_COMPUTE_TEXTURE_IMAGE_UNITS = 0x91BC;
    public const MAX_COMPUTE_IMAGE_UNIFORMS = 0x91BD;
    public const MAX_COMPUTE_SHARED_MEMORY_SIZE = 0x8262;
    public const MAX_COMPUTE_UNIFORM_COMPONENTS = 0x8263;
    public const MAX_COMPUTE_ATOMIC_COUNTER_BUFFERS = 0x8264;
    public const MAX_COMPUTE_ATOMIC_COUNTERS = 0x8265;
    public const MAX_COMBINED_COMPUTE_UNIFORM_COMPONENTS = 0x8266;
    public const MAX_COMPUTE_WORK_GROUP_INVOCATIONS = 0x90EB;
    public const MAX_COMPUTE_WORK_GROUP_COUNT = 0x91BE;
    public const MAX_COMPUTE_WORK_GROUP_SIZE = 0x91BF;
    public const COMPUTE_WORK_GROUP_SIZE = 0x8267;
    public const UNIFORM_BLOCK_REFERENCED_BY_COMPUTE_SHADER = 0x90EC;
    public const ATOMIC_COUNTER_BUFFER_REFERENCED_BY_COMPUTE_SHADER = 0x90ED;
    public const DISPATCH_INDIRECT_BUFFER = 0x90EE;
    public const DISPATCH_INDIRECT_BUFFER_BINDING = 0x90EF;
    public const COMPUTE_SHADER_BIT = 0x00000020;
    public const DEBUG_OUTPUT_SYNCHRONOUS = 0x8242;
    public const DEBUG_NEXT_LOGGED_MESSAGE_LENGTH = 0x8243;
    public const DEBUG_CALLBACK_FUNCTION = 0x8244;
    public const DEBUG_CALLBACK_USER_PARAM = 0x8245;
    public const DEBUG_SOURCE_API = 0x8246;
    public const DEBUG_SOURCE_WINDOW_SYSTEM = 0x8247;
    public const DEBUG_SOURCE_SHADER_COMPILER = 0x8248;
    public const DEBUG_SOURCE_THIRD_PARTY = 0x8249;
    public const DEBUG_SOURCE_APPLICATION = 0x824A;
    public const DEBUG_SOURCE_OTHER = 0x824B;
    public const DEBUG_TYPE_ERROR = 0x824C;
    public const DEBUG_TYPE_DEPRECATED_BEHAVIOR = 0x824D;
    public const DEBUG_TYPE_UNDEFINED_BEHAVIOR = 0x824E;
    public const DEBUG_TYPE_PORTABILITY = 0x824F;
    public const DEBUG_TYPE_PERFORMANCE = 0x8250;
    public const DEBUG_TYPE_OTHER = 0x8251;
    public const MAX_DEBUG_MESSAGE_LENGTH = 0x9143;
    public const MAX_DEBUG_LOGGED_MESSAGES = 0x9144;
    public const DEBUG_LOGGED_MESSAGES = 0x9145;
    public const DEBUG_SEVERITY_HIGH = 0x9146;
    public const DEBUG_SEVERITY_MEDIUM = 0x9147;
    public const DEBUG_SEVERITY_LOW = 0x9148;
    public const DEBUG_TYPE_MARKER = 0x8268;
    public const DEBUG_TYPE_PUSH_GROUP = 0x8269;
    public const DEBUG_TYPE_POP_GROUP = 0x826A;
    public const DEBUG_SEVERITY_NOTIFICATION = 0x826B;
    public const MAX_DEBUG_GROUP_STACK_DEPTH = 0x826C;
    public const DEBUG_GROUP_STACK_DEPTH = 0x826D;
    public const BUFFER = 0x82E0;
    public const SHADER = 0x82E1;
    public const PROGRAM = 0x82E2;
    public const QUERY = 0x82E3;
    public const PROGRAM_PIPELINE = 0x82E4;
    public const SAMPLER = 0x82E6;
    public const MAX_LABEL_LENGTH = 0x82E8;
    public const DEBUG_OUTPUT = 0x92E0;
    public const CONTEXT_FLAG_DEBUG_BIT = 0x00000002;
    public const MAX_UNIFORM_LOCATIONS = 0x826E;
    public const FRAMEBUFFER_DEFAULT_WIDTH = 0x9310;
    public const FRAMEBUFFER_DEFAULT_HEIGHT = 0x9311;
    public const FRAMEBUFFER_DEFAULT_LAYERS = 0x9312;
    public const FRAMEBUFFER_DEFAULT_SAMPLES = 0x9313;
    public const FRAMEBUFFER_DEFAULT_FIXED_SAMPLE_LOCATIONS = 0x9314;
    public const MAX_FRAMEBUFFER_WIDTH = 0x9315;
    public const MAX_FRAMEBUFFER_HEIGHT = 0x9316;
    public const MAX_FRAMEBUFFER_LAYERS = 0x9317;
    public const MAX_FRAMEBUFFER_SAMPLES = 0x9318;
    public const INTERNALFORMAT_SUPPORTED = 0x826F;
    public const INTERNALFORMAT_PREFERRED = 0x8270;
    public const INTERNALFORMAT_RED_SIZE = 0x8271;
    public const INTERNALFORMAT_GREEN_SIZE = 0x8272;
    public const INTERNALFORMAT_BLUE_SIZE = 0x8273;
    public const INTERNALFORMAT_ALPHA_SIZE = 0x8274;
    public const INTERNALFORMAT_DEPTH_SIZE = 0x8275;
    public const INTERNALFORMAT_STENCIL_SIZE = 0x8276;
    public const INTERNALFORMAT_SHARED_SIZE = 0x8277;
    public const INTERNALFORMAT_RED_TYPE = 0x8278;
    public const INTERNALFORMAT_GREEN_TYPE = 0x8279;
    public const INTERNALFORMAT_BLUE_TYPE = 0x827A;
    public const INTERNALFORMAT_ALPHA_TYPE = 0x827B;
    public const INTERNALFORMAT_DEPTH_TYPE = 0x827C;
    public const INTERNALFORMAT_STENCIL_TYPE = 0x827D;
    public const MAX_WIDTH = 0x827E;
    public const MAX_HEIGHT = 0x827F;
    public const MAX_DEPTH = 0x8280;
    public const MAX_LAYERS = 0x8281;
    public const MAX_COMBINED_DIMENSIONS = 0x8282;
    public const COLOR_COMPONENTS = 0x8283;
    public const DEPTH_COMPONENTS = 0x8284;
    public const STENCIL_COMPONENTS = 0x8285;
    public const COLOR_RENDERABLE = 0x8286;
    public const DEPTH_RENDERABLE = 0x8287;
    public const STENCIL_RENDERABLE = 0x8288;
    public const FRAMEBUFFER_RENDERABLE = 0x8289;
    public const FRAMEBUFFER_RENDERABLE_LAYERED = 0x828A;
    public const FRAMEBUFFER_BLEND = 0x828B;
    public const READ_PIXELS = 0x828C;
    public const READ_PIXELS_FORMAT = 0x828D;
    public const READ_PIXELS_TYPE = 0x828E;
    public const TEXTURE_IMAGE_FORMAT = 0x828F;
    public const TEXTURE_IMAGE_TYPE = 0x8290;
    public const GET_TEXTURE_IMAGE_FORMAT = 0x8291;
    public const GET_TEXTURE_IMAGE_TYPE = 0x8292;
    public const MIPMAP = 0x8293;
    public const MANUAL_GENERATE_MIPMAP = 0x8294;
    public const AUTO_GENERATE_MIPMAP = 0x8295;
    public const COLOR_ENCODING = 0x8296;
    public const SRGB_READ = 0x8297;
    public const SRGB_WRITE = 0x8298;
    public const FILTER = 0x829A;
    public const VERTEX_TEXTURE = 0x829B;
    public const TESS_CONTROL_TEXTURE = 0x829C;
    public const TESS_EVALUATION_TEXTURE = 0x829D;
    public const GEOMETRY_TEXTURE = 0x829E;
    public const FRAGMENT_TEXTURE = 0x829F;
    public const COMPUTE_TEXTURE = 0x82A0;
    public const TEXTURE_SHADOW = 0x82A1;
    public const TEXTURE_GATHER = 0x82A2;
    public const TEXTURE_GATHER_SHADOW = 0x82A3;
    public const SHADER_IMAGE_LOAD = 0x82A4;
    public const SHADER_IMAGE_STORE = 0x82A5;
    public const SHADER_IMAGE_ATOMIC = 0x82A6;
    public const IMAGE_TEXEL_SIZE = 0x82A7;
    public const IMAGE_COMPATIBILITY_CLASS = 0x82A8;
    public const IMAGE_PIXEL_FORMAT = 0x82A9;
    public const IMAGE_PIXEL_TYPE = 0x82AA;
    public const SIMULTANEOUS_TEXTURE_AND_DEPTH_TEST = 0x82AC;
    public const SIMULTANEOUS_TEXTURE_AND_STENCIL_TEST = 0x82AD;
    public const SIMULTANEOUS_TEXTURE_AND_DEPTH_WRITE = 0x82AE;
    public const SIMULTANEOUS_TEXTURE_AND_STENCIL_WRITE = 0x82AF;
    public const TEXTURE_COMPRESSED_BLOCK_WIDTH = 0x82B1;
    public const TEXTURE_COMPRESSED_BLOCK_HEIGHT = 0x82B2;
    public const TEXTURE_COMPRESSED_BLOCK_SIZE = 0x82B3;
    public const CLEAR_BUFFER = 0x82B4;
    public const TEXTURE_VIEW = 0x82B5;
    public const VIEW_COMPATIBILITY_CLASS = 0x82B6;
    public const FULL_SUPPORT = 0x82B7;
    public const CAVEAT_SUPPORT = 0x82B8;
    public const IMAGE_CLASS_4_X_32 = 0x82B9;
    public const IMAGE_CLASS_2_X_32 = 0x82BA;
    public const IMAGE_CLASS_1_X_32 = 0x82BB;
    public const IMAGE_CLASS_4_X_16 = 0x82BC;
    public const IMAGE_CLASS_2_X_16 = 0x82BD;
    public const IMAGE_CLASS_1_X_16 = 0x82BE;
    public const IMAGE_CLASS_4_X_8 = 0x82BF;
    public const IMAGE_CLASS_2_X_8 = 0x82C0;
    public const IMAGE_CLASS_1_X_8 = 0x82C1;
    public const IMAGE_CLASS_11_11_10 = 0x82C2;
    public const IMAGE_CLASS_10_10_10_2 = 0x82C3;
    public const VIEW_CLASS_128_BITS = 0x82C4;
    public const VIEW_CLASS_96_BITS = 0x82C5;
    public const VIEW_CLASS_64_BITS = 0x82C6;
    public const VIEW_CLASS_48_BITS = 0x82C7;
    public const VIEW_CLASS_32_BITS = 0x82C8;
    public const VIEW_CLASS_24_BITS = 0x82C9;
    public const VIEW_CLASS_16_BITS = 0x82CA;
    public const VIEW_CLASS_8_BITS = 0x82CB;
    public const VIEW_CLASS_S3TC_DXT1_RGB = 0x82CC;
    public const VIEW_CLASS_S3TC_DXT1_RGBA = 0x82CD;
    public const VIEW_CLASS_S3TC_DXT3_RGBA = 0x82CE;
    public const VIEW_CLASS_S3TC_DXT5_RGBA = 0x82CF;
    public const VIEW_CLASS_RGTC1_RED = 0x82D0;
    public const VIEW_CLASS_RGTC2_RG = 0x82D1;
    public const VIEW_CLASS_BPTC_UNORM = 0x82D2;
    public const VIEW_CLASS_BPTC_FLOAT = 0x82D3;
    public const UNIFORM = 0x92E1;
    public const UNIFORM_BLOCK = 0x92E2;
    public const PROGRAM_INPUT = 0x92E3;
    public const PROGRAM_OUTPUT = 0x92E4;
    public const BUFFER_VARIABLE = 0x92E5;
    public const SHADER_STORAGE_BLOCK = 0x92E6;
    public const VERTEX_SUBROUTINE = 0x92E8;
    public const TESS_CONTROL_SUBROUTINE = 0x92E9;
    public const TESS_EVALUATION_SUBROUTINE = 0x92EA;
    public const GEOMETRY_SUBROUTINE = 0x92EB;
    public const FRAGMENT_SUBROUTINE = 0x92EC;
    public const COMPUTE_SUBROUTINE = 0x92ED;
    public const VERTEX_SUBROUTINE_UNIFORM = 0x92EE;
    public const TESS_CONTROL_SUBROUTINE_UNIFORM = 0x92EF;
    public const TESS_EVALUATION_SUBROUTINE_UNIFORM = 0x92F0;
    public const GEOMETRY_SUBROUTINE_UNIFORM = 0x92F1;
    public const FRAGMENT_SUBROUTINE_UNIFORM = 0x92F2;
    public const COMPUTE_SUBROUTINE_UNIFORM = 0x92F3;
    public const TRANSFORM_FEEDBACK_VARYING = 0x92F4;
    public const ACTIVE_RESOURCES = 0x92F5;
    public const MAX_NAME_LENGTH = 0x92F6;
    public const MAX_NUM_ACTIVE_VARIABLES = 0x92F7;
    public const MAX_NUM_COMPATIBLE_SUBROUTINES = 0x92F8;
    public const NAME_LENGTH = 0x92F9;
    public const TYPE = 0x92FA;
    public const ARRAY_SIZE = 0x92FB;
    public const OFFSET = 0x92FC;
    public const BLOCK_INDEX = 0x92FD;
    public const ARRAY_STRIDE = 0x92FE;
    public const MATRIX_STRIDE = 0x92FF;
    public const IS_ROW_MAJOR = 0x9300;
    public const ATOMIC_COUNTER_BUFFER_INDEX = 0x9301;
    public const BUFFER_BINDING = 0x9302;
    public const BUFFER_DATA_SIZE = 0x9303;
    public const NUM_ACTIVE_VARIABLES = 0x9304;
    public const ACTIVE_VARIABLES = 0x9305;
    public const REFERENCED_BY_VERTEX_SHADER = 0x9306;
    public const REFERENCED_BY_TESS_CONTROL_SHADER = 0x9307;
    public const REFERENCED_BY_TESS_EVALUATION_SHADER = 0x9308;
    public const REFERENCED_BY_GEOMETRY_SHADER = 0x9309;
    public const REFERENCED_BY_FRAGMENT_SHADER = 0x930A;
    public const REFERENCED_BY_COMPUTE_SHADER = 0x930B;
    public const TOP_LEVEL_ARRAY_SIZE = 0x930C;
    public const TOP_LEVEL_ARRAY_STRIDE = 0x930D;
    public const LOCATION = 0x930E;
    public const LOCATION_INDEX = 0x930F;
    public const IS_PER_PATCH = 0x92E7;
    public const SHADER_STORAGE_BUFFER = 0x90D2;
    public const SHADER_STORAGE_BUFFER_BINDING = 0x90D3;
    public const SHADER_STORAGE_BUFFER_START = 0x90D4;
    public const SHADER_STORAGE_BUFFER_SIZE = 0x90D5;
    public const MAX_VERTEX_SHADER_STORAGE_BLOCKS = 0x90D6;
    public const MAX_GEOMETRY_SHADER_STORAGE_BLOCKS = 0x90D7;
    public const MAX_TESS_CONTROL_SHADER_STORAGE_BLOCKS = 0x90D8;
    public const MAX_TESS_EVALUATION_SHADER_STORAGE_BLOCKS = 0x90D9;
    public const MAX_FRAGMENT_SHADER_STORAGE_BLOCKS = 0x90DA;
    public const MAX_COMPUTE_SHADER_STORAGE_BLOCKS = 0x90DB;
    public const MAX_COMBINED_SHADER_STORAGE_BLOCKS = 0x90DC;
    public const MAX_SHADER_STORAGE_BUFFER_BINDINGS = 0x90DD;
    public const MAX_SHADER_STORAGE_BLOCK_SIZE = 0x90DE;
    public const SHADER_STORAGE_BUFFER_OFFSET_ALIGNMENT = 0x90DF;
    public const SHADER_STORAGE_BARRIER_BIT = 0x00002000;
    public const MAX_COMBINED_SHADER_OUTPUT_RESOURCES = 0x8F39;
    public const DEPTH_STENCIL_TEXTURE_MODE = 0x90EA;
    public const TEXTURE_BUFFER_OFFSET = 0x919D;
    public const TEXTURE_BUFFER_SIZE = 0x919E;
    public const TEXTURE_BUFFER_OFFSET_ALIGNMENT = 0x919F;
    public const TEXTURE_VIEW_MIN_LEVEL = 0x82DB;
    public const TEXTURE_VIEW_NUM_LEVELS = 0x82DC;
    public const TEXTURE_VIEW_MIN_LAYER = 0x82DD;
    public const TEXTURE_VIEW_NUM_LAYERS = 0x82DE;
    public const TEXTURE_IMMUTABLE_LEVELS = 0x82DF;
    public const VERTEX_ATTRIB_BINDING = 0x82D4;
    public const VERTEX_ATTRIB_RELATIVE_OFFSET = 0x82D5;
    public const VERTEX_BINDING_DIVISOR = 0x82D6;
    public const VERTEX_BINDING_OFFSET = 0x82D7;
    public const VERTEX_BINDING_STRIDE = 0x82D8;
    public const MAX_VERTEX_ATTRIB_RELATIVE_OFFSET = 0x82D9;
    public const MAX_VERTEX_ATTRIB_BINDINGS = 0x82DA;
    public const VERTEX_BINDING_BUFFER = 0x8F4F;
    public const MAX_VERTEX_ATTRIB_STRIDE = 0x82E5;
    public const PRIMITIVE_RESTART_FOR_PATCHES_SUPPORTED = 0x8221;
    public const TEXTURE_BUFFER_BINDING = 0x8C2A;
    public const MAP_PERSISTENT_BIT = 0x0040;
    public const MAP_COHERENT_BIT = 0x0080;
    public const DYNAMIC_STORAGE_BIT = 0x0100;
    public const CLIENT_STORAGE_BIT = 0x0200;
    public const CLIENT_MAPPED_BUFFER_BARRIER_BIT = 0x00004000;
    public const BUFFER_IMMUTABLE_STORAGE = 0x821F;
    public const BUFFER_STORAGE_FLAGS = 0x8220;
    public const CLEAR_TEXTURE = 0x9365;
    public const LOCATION_COMPONENT = 0x934A;
    public const TRANSFORM_FEEDBACK_BUFFER_INDEX = 0x934B;
    public const TRANSFORM_FEEDBACK_BUFFER_STRIDE = 0x934C;
    public const QUERY_BUFFER = 0x9192;
    public const QUERY_BUFFER_BARRIER_BIT = 0x00008000;
    public const QUERY_BUFFER_BINDING = 0x9193;
    public const QUERY_RESULT_NO_WAIT = 0x9194;
    public const MIRROR_CLAMP_TO_EDGE = 0x8743;
    public const CONTEXT_LOST = 0x0507;
    public const NEGATIVE_ONE_TO_ONE = 0x935E;
    public const ZERO_TO_ONE = 0x935F;
    public const CLIP_ORIGIN = 0x935C;
    public const CLIP_DEPTH_MODE = 0x935D;
    public const QUERY_WAIT_INVERTED = 0x8E17;
    public const QUERY_NO_WAIT_INVERTED = 0x8E18;
    public const QUERY_BY_REGION_WAIT_INVERTED = 0x8E19;
    public const QUERY_BY_REGION_NO_WAIT_INVERTED = 0x8E1A;
    public const MAX_CULL_DISTANCES = 0x82F9;
    public const MAX_COMBINED_CLIP_AND_CULL_DISTANCES = 0x82FA;
    public const TEXTURE_TARGET = 0x1006;
    public const QUERY_TARGET = 0x82EA;
    public const GUILTY_CONTEXT_RESET = 0x8253;
    public const INNOCENT_CONTEXT_RESET = 0x8254;
    public const UNKNOWN_CONTEXT_RESET = 0x8255;
    public const RESET_NOTIFICATION_STRATEGY = 0x8256;
    public const LOSE_CONTEXT_ON_RESET = 0x8252;
    public const NO_RESET_NOTIFICATION = 0x8261;
    public const CONTEXT_FLAG_ROBUST_ACCESS_BIT = 0x00000004;
    public const CONTEXT_RELEASE_BEHAVIOR = 0x82FB;
    public const CONTEXT_RELEASE_BEHAVIOR_FLUSH = 0x82FC;
    public const SHADER_BINARY_FORMAT_SPIR_V = 0x9551;
    public const SPIR_V_BINARY = 0x9552;
    public const PARAMETER_BUFFER = 0x80EE;
    public const PARAMETER_BUFFER_BINDING = 0x80EF;
    public const CONTEXT_FLAG_NO_ERROR_BIT = 0x00000008;
    public const VERTICES_SUBMITTED = 0x82EE;
    public const PRIMITIVES_SUBMITTED = 0x82EF;
    public const VERTEX_SHADER_INVOCATIONS = 0x82F0;
    public const TESS_CONTROL_SHADER_PATCHES = 0x82F1;
    public const TESS_EVALUATION_SHADER_INVOCATIONS = 0x82F2;
    public const GEOMETRY_SHADER_PRIMITIVES_EMITTED = 0x82F3;
    public const FRAGMENT_SHADER_INVOCATIONS = 0x82F4;
    public const COMPUTE_SHADER_INVOCATIONS = 0x82F5;
    public const CLIPPING_INPUT_PRIMITIVES = 0x82F6;
    public const CLIPPING_OUTPUT_PRIMITIVES = 0x82F7;
    public const POLYGON_OFFSET_CLAMP = 0x8E1B;
    public const SPIR_V_EXTENSIONS = 0x9553;
    public const NUM_SPIR_V_EXTENSIONS = 0x9554;
    public const TEXTURE_MAX_ANISOTROPY = 0x84FE;
    public const MAX_TEXTURE_MAX_ANISOTROPY = 0x84FF;
    public const TRANSFORM_FEEDBACK_OVERFLOW = 0x82EC;
    public const TRANSFORM_FEEDBACK_STREAM_OVERFLOW = 0x82ED;
    public const ARB_ES2_compatibility = 1;
    public const ARB_ES3_1_compatibility = 1;
    public const ARB_ES3_2_compatibility = 1;
    public const PRIMITIVE_BOUNDING_BOX_ARB = 0x92BE;
    public const MULTISAMPLE_LINE_WIDTH_RANGE_ARB = 0x9381;
    public const MULTISAMPLE_LINE_WIDTH_GRANULARITY_ARB = 0x9382;
    public const ARB_ES3_compatibility = 1;
    public const ARB_arrays_of_arrays = 1;
    public const ARB_base_instance = 1;
    public const ARB_bindless_texture = 1;
    public const UNSIGNED_INT64_ARB = 0x140F;
    public const ARB_blend_func_extended = 1;
    public const ARB_buffer_storage = 1;
    public const ARB_cl_event = 1;
    public const SYNC_CL_EVENT_ARB = 0x8240;
    public const SYNC_CL_EVENT_COMPLETE_ARB = 0x8241;
    public const ARB_clear_buffer_object = 1;
    public const ARB_clear_texture = 1;
    public const ARB_clip_control = 1;
    public const ARB_compressed_texture_pixel_storage = 1;
    public const ARB_compute_shader = 1;
    public const ARB_compute_variable_group_size = 1;
    public const MAX_COMPUTE_VARIABLE_GROUP_INVOCATIONS_ARB = 0x9344;
    public const MAX_COMPUTE_FIXED_GROUP_INVOCATIONS_ARB = 0x90EB;
    public const MAX_COMPUTE_VARIABLE_GROUP_SIZE_ARB = 0x9345;
    public const MAX_COMPUTE_FIXED_GROUP_SIZE_ARB = 0x91BF;
    public const ARB_conditional_render_inverted = 1;
    public const ARB_conservative_depth = 1;
    public const ARB_copy_buffer = 1;
    public const ARB_copy_image = 1;
    public const ARB_cull_distance = 1;
    public const ARB_debug_output = 1;
    public const DEBUG_OUTPUT_SYNCHRONOUS_ARB = 0x8242;
    public const DEBUG_NEXT_LOGGED_MESSAGE_LENGTH_ARB = 0x8243;
    public const DEBUG_CALLBACK_FUNCTION_ARB = 0x8244;
    public const DEBUG_CALLBACK_USER_PARAM_ARB = 0x8245;
    public const DEBUG_SOURCE_API_ARB = 0x8246;
    public const DEBUG_SOURCE_WINDOW_SYSTEM_ARB = 0x8247;
    public const DEBUG_SOURCE_SHADER_COMPILER_ARB = 0x8248;
    public const DEBUG_SOURCE_THIRD_PARTY_ARB = 0x8249;
    public const DEBUG_SOURCE_APPLICATION_ARB = 0x824A;
    public const DEBUG_SOURCE_OTHER_ARB = 0x824B;
    public const DEBUG_TYPE_ERROR_ARB = 0x824C;
    public const DEBUG_TYPE_DEPRECATED_BEHAVIOR_ARB = 0x824D;
    public const DEBUG_TYPE_UNDEFINED_BEHAVIOR_ARB = 0x824E;
    public const DEBUG_TYPE_PORTABILITY_ARB = 0x824F;
    public const DEBUG_TYPE_PERFORMANCE_ARB = 0x8250;
    public const DEBUG_TYPE_OTHER_ARB = 0x8251;
    public const MAX_DEBUG_MESSAGE_LENGTH_ARB = 0x9143;
    public const MAX_DEBUG_LOGGED_MESSAGES_ARB = 0x9144;
    public const DEBUG_LOGGED_MESSAGES_ARB = 0x9145;
    public const DEBUG_SEVERITY_HIGH_ARB = 0x9146;
    public const DEBUG_SEVERITY_MEDIUM_ARB = 0x9147;
    public const DEBUG_SEVERITY_LOW_ARB = 0x9148;
    public const ARB_depth_buffer_float = 1;
    public const ARB_depth_clamp = 1;
    public const ARB_derivative_control = 1;
    public const ARB_direct_state_access = 1;
    public const ARB_draw_buffers_blend = 1;
    public const ARB_draw_elements_base_vertex = 1;
    public const ARB_draw_indirect = 1;
    public const ARB_draw_instanced = 1;
    public const ARB_enhanced_layouts = 1;
    public const ARB_explicit_attrib_location = 1;
    public const ARB_explicit_uniform_location = 1;
    public const ARB_fragment_coord_conventions = 1;
    public const ARB_fragment_layer_viewport = 1;
    public const ARB_fragment_shader_interlock = 1;
    public const ARB_framebuffer_no_attachments = 1;
    public const ARB_framebuffer_object = 1;
    public const ARB_framebuffer_sRGB = 1;
    public const ARB_geometry_shader4 = 1;
    public const LINES_ADJACENCY_ARB = 0x000A;
    public const LINE_STRIP_ADJACENCY_ARB = 0x000B;
    public const TRIANGLES_ADJACENCY_ARB = 0x000C;
    public const TRIANGLE_STRIP_ADJACENCY_ARB = 0x000D;
    public const PROGRAM_POINT_SIZE_ARB = 0x8642;
    public const MAX_GEOMETRY_TEXTURE_IMAGE_UNITS_ARB = 0x8C29;
    public const FRAMEBUFFER_ATTACHMENT_LAYERED_ARB = 0x8DA7;
    public const FRAMEBUFFER_INCOMPLETE_LAYER_TARGETS_ARB = 0x8DA8;
    public const FRAMEBUFFER_INCOMPLETE_LAYER_COUNT_ARB = 0x8DA9;
    public const GEOMETRY_SHADER_ARB = 0x8DD9;
    public const GEOMETRY_VERTICES_OUT_ARB = 0x8DDA;
    public const GEOMETRY_INPUT_TYPE_ARB = 0x8DDB;
    public const GEOMETRY_OUTPUT_TYPE_ARB = 0x8DDC;
    public const MAX_GEOMETRY_VARYING_COMPONENTS_ARB = 0x8DDD;
    public const MAX_VERTEX_VARYING_COMPONENTS_ARB = 0x8DDE;
    public const MAX_GEOMETRY_UNIFORM_COMPONENTS_ARB = 0x8DDF;
    public const MAX_GEOMETRY_OUTPUT_VERTICES_ARB = 0x8DE0;
    public const MAX_GEOMETRY_TOTAL_OUTPUT_COMPONENTS_ARB = 0x8DE1;
    public const ARB_get_program_binary = 1;
    public const ARB_get_texture_sub_image = 1;
    public const ARB_gl_spirv = 1;
    public const SHADER_BINARY_FORMAT_SPIR_V_ARB = 0x9551;
    public const SPIR_V_BINARY_ARB = 0x9552;
    public const ARB_gpu_shader5 = 1;
    public const ARB_gpu_shader_fp64 = 1;
    public const ARB_gpu_shader_int64 = 1;
    public const INT64_ARB = 0x140E;
    public const INT64_VEC2_ARB = 0x8FE9;
    public const INT64_VEC3_ARB = 0x8FEA;
    public const INT64_VEC4_ARB = 0x8FEB;
    public const UNSIGNED_INT64_VEC2_ARB = 0x8FF5;
    public const UNSIGNED_INT64_VEC3_ARB = 0x8FF6;
    public const UNSIGNED_INT64_VEC4_ARB = 0x8FF7;
    public const ARB_half_float_vertex = 1;
    public const ARB_imaging = 1;
    public const ARB_indirect_parameters = 1;
    public const PARAMETER_BUFFER_ARB = 0x80EE;
    public const PARAMETER_BUFFER_BINDING_ARB = 0x80EF;
    public const ARB_instanced_arrays = 1;
    public const VERTEX_ATTRIB_ARRAY_DIVISOR_ARB = 0x88FE;
    public const ARB_internalformat_query = 1;
    public const ARB_internalformat_query2 = 1;
    public const SRGB_DECODE_ARB = 0x8299;
    public const VIEW_CLASS_EAC_R11 = 0x9383;
    public const VIEW_CLASS_EAC_RG11 = 0x9384;
    public const VIEW_CLASS_ETC2_RGB = 0x9385;
    public const VIEW_CLASS_ETC2_RGBA = 0x9386;
    public const VIEW_CLASS_ETC2_EAC_RGBA = 0x9387;
    public const VIEW_CLASS_ASTC_4x4_RGBA = 0x9388;
    public const VIEW_CLASS_ASTC_5x4_RGBA = 0x9389;
    public const VIEW_CLASS_ASTC_5x5_RGBA = 0x938A;
    public const VIEW_CLASS_ASTC_6x5_RGBA = 0x938B;
    public const VIEW_CLASS_ASTC_6x6_RGBA = 0x938C;
    public const VIEW_CLASS_ASTC_8x5_RGBA = 0x938D;
    public const VIEW_CLASS_ASTC_8x6_RGBA = 0x938E;
    public const VIEW_CLASS_ASTC_8x8_RGBA = 0x938F;
    public const VIEW_CLASS_ASTC_10x5_RGBA = 0x9390;
    public const VIEW_CLASS_ASTC_10x6_RGBA = 0x9391;
    public const VIEW_CLASS_ASTC_10x8_RGBA = 0x9392;
    public const VIEW_CLASS_ASTC_10x10_RGBA = 0x9393;
    public const VIEW_CLASS_ASTC_12x10_RGBA = 0x9394;
    public const VIEW_CLASS_ASTC_12x12_RGBA = 0x9395;
    public const ARB_invalidate_subdata = 1;
    public const ARB_map_buffer_alignment = 1;
    public const ARB_map_buffer_range = 1;
    public const ARB_multi_bind = 1;
    public const ARB_multi_draw_indirect = 1;
    public const ARB_occlusion_query2 = 1;
    public const ARB_parallel_shader_compile = 1;
    public const MAX_SHADER_COMPILER_THREADS_ARB = 0x91B0;
    public const COMPLETION_STATUS_ARB = 0x91B1;
    public const ARB_pipeline_statistics_query = 1;
    public const VERTICES_SUBMITTED_ARB = 0x82EE;
    public const PRIMITIVES_SUBMITTED_ARB = 0x82EF;
    public const VERTEX_SHADER_INVOCATIONS_ARB = 0x82F0;
    public const TESS_CONTROL_SHADER_PATCHES_ARB = 0x82F1;
    public const TESS_EVALUATION_SHADER_INVOCATIONS_ARB = 0x82F2;
    public const GEOMETRY_SHADER_PRIMITIVES_EMITTED_ARB = 0x82F3;
    public const FRAGMENT_SHADER_INVOCATIONS_ARB = 0x82F4;
    public const COMPUTE_SHADER_INVOCATIONS_ARB = 0x82F5;
    public const CLIPPING_INPUT_PRIMITIVES_ARB = 0x82F6;
    public const CLIPPING_OUTPUT_PRIMITIVES_ARB = 0x82F7;
    public const ARB_pixel_buffer_object = 1;
    public const PIXEL_PACK_BUFFER_ARB = 0x88EB;
    public const PIXEL_UNPACK_BUFFER_ARB = 0x88EC;
    public const PIXEL_PACK_BUFFER_BINDING_ARB = 0x88ED;
    public const PIXEL_UNPACK_BUFFER_BINDING_ARB = 0x88EF;
    public const ARB_polygon_offset_clamp = 1;
    public const ARB_post_depth_coverage = 1;
    public const ARB_program_interface_query = 1;
    public const ARB_provoking_vertex = 1;
    public const ARB_query_buffer_object = 1;
    public const ARB_robust_buffer_access_behavior = 1;
    public const ARB_robustness = 1;
    public const CONTEXT_FLAG_ROBUST_ACCESS_BIT_ARB = 0x00000004;
    public const LOSE_CONTEXT_ON_RESET_ARB = 0x8252;
    public const GUILTY_CONTEXT_RESET_ARB = 0x8253;
    public const INNOCENT_CONTEXT_RESET_ARB = 0x8254;
    public const UNKNOWN_CONTEXT_RESET_ARB = 0x8255;
    public const RESET_NOTIFICATION_STRATEGY_ARB = 0x8256;
    public const NO_RESET_NOTIFICATION_ARB = 0x8261;
    public const ARB_robustness_isolation = 1;
    public const ARB_sample_locations = 1;
    public const SAMPLE_LOCATION_SUBPIXEL_BITS_ARB = 0x933D;
    public const SAMPLE_LOCATION_PIXEL_GRID_WIDTH_ARB = 0x933E;
    public const SAMPLE_LOCATION_PIXEL_GRID_HEIGHT_ARB = 0x933F;
    public const PROGRAMMABLE_SAMPLE_LOCATION_TABLE_SIZE_ARB = 0x9340;
    public const SAMPLE_LOCATION_ARB = 0x8E50;
    public const PROGRAMMABLE_SAMPLE_LOCATION_ARB = 0x9341;
    public const FRAMEBUFFER_PROGRAMMABLE_SAMPLE_LOCATIONS_ARB = 0x9342;
    public const FRAMEBUFFER_SAMPLE_LOCATION_PIXEL_GRID_ARB = 0x9343;
    public const ARB_sample_shading = 1;
    public const SAMPLE_SHADING_ARB = 0x8C36;
    public const MIN_SAMPLE_SHADING_VALUE_ARB = 0x8C37;
    public const ARB_sampler_objects = 1;
    public const ARB_seamless_cube_map = 1;
    public const ARB_seamless_cubemap_per_texture = 1;
    public const ARB_separate_shader_objects = 1;
    public const ARB_shader_atomic_counter_ops = 1;
    public const ARB_shader_atomic_counters = 1;
    public const ARB_shader_ballot = 1;
    public const ARB_shader_bit_encoding = 1;
    public const ARB_shader_clock = 1;
    public const ARB_shader_draw_parameters = 1;
    public const ARB_shader_group_vote = 1;
    public const ARB_shader_image_load_store = 1;
    public const ARB_shader_image_size = 1;
    public const ARB_shader_precision = 1;
    public const ARB_shader_stencil_export = 1;
    public const ARB_shader_storage_buffer_object = 1;
    public const ARB_shader_subroutine = 1;
    public const ARB_shader_texture_image_samples = 1;
    public const ARB_shader_viewport_layer_array = 1;
    public const ARB_shading_language_420pack = 1;
    public const ARB_shading_language_include = 1;
    public const SHADER_INCLUDE_ARB = 0x8DAE;
    public const NAMED_STRING_LENGTH_ARB = 0x8DE9;
    public const NAMED_STRING_TYPE_ARB = 0x8DEA;
    public const ARB_shading_language_packing = 1;
    public const ARB_sparse_buffer = 1;
    public const SPARSE_STORAGE_BIT_ARB = 0x0400;
    public const SPARSE_BUFFER_PAGE_SIZE_ARB = 0x82F8;
    public const ARB_sparse_texture = 1;
    public const TEXTURE_SPARSE_ARB = 0x91A6;
    public const VIRTUAL_PAGE_SIZE_INDEX_ARB = 0x91A7;
    public const NUM_SPARSE_LEVELS_ARB = 0x91AA;
    public const NUM_VIRTUAL_PAGE_SIZES_ARB = 0x91A8;
    public const VIRTUAL_PAGE_SIZE_X_ARB = 0x9195;
    public const VIRTUAL_PAGE_SIZE_Y_ARB = 0x9196;
    public const VIRTUAL_PAGE_SIZE_Z_ARB = 0x9197;
    public const MAX_SPARSE_TEXTURE_SIZE_ARB = 0x9198;
    public const MAX_SPARSE_3D_TEXTURE_SIZE_ARB = 0x9199;
    public const MAX_SPARSE_ARRAY_TEXTURE_LAYERS_ARB = 0x919A;
    public const SPARSE_TEXTURE_FULL_ARRAY_CUBE_MIPMAPS_ARB = 0x91A9;
    public const ARB_sparse_texture2 = 1;
    public const ARB_sparse_texture_clamp = 1;
    public const ARB_spirv_extensions = 1;
    public const ARB_stencil_texturing = 1;
    public const ARB_sync = 1;
    public const ARB_tessellation_shader = 1;
    public const ARB_texture_barrier = 1;
    public const ARB_texture_border_clamp = 1;
    public const CLAMP_TO_BORDER_ARB = 0x812D;
    public const ARB_texture_buffer_object = 1;
    public const TEXTURE_BUFFER_ARB = 0x8C2A;
    public const MAX_TEXTURE_BUFFER_SIZE_ARB = 0x8C2B;
    public const TEXTURE_BINDING_BUFFER_ARB = 0x8C2C;
    public const TEXTURE_BUFFER_DATA_STORE_BINDING_ARB = 0x8C2D;
    public const TEXTURE_BUFFER_FORMAT_ARB = 0x8C2E;
    public const ARB_texture_buffer_object_rgb32 = 1;
    public const ARB_texture_buffer_range = 1;
    public const ARB_texture_compression_bptc = 1;
    public const COMPRESSED_RGBA_BPTC_UNORM_ARB = 0x8E8C;
    public const COMPRESSED_SRGB_ALPHA_BPTC_UNORM_ARB = 0x8E8D;
    public const COMPRESSED_RGB_BPTC_SIGNED_FLOAT_ARB = 0x8E8E;
    public const COMPRESSED_RGB_BPTC_UNSIGNED_FLOAT_ARB = 0x8E8F;
    public const ARB_texture_compression_rgtc = 1;
    public const ARB_texture_cube_map_array = 1;
    public const TEXTURE_CUBE_MAP_ARRAY_ARB = 0x9009;
    public const TEXTURE_BINDING_CUBE_MAP_ARRAY_ARB = 0x900A;
    public const PROXY_TEXTURE_CUBE_MAP_ARRAY_ARB = 0x900B;
    public const SAMPLER_CUBE_MAP_ARRAY_ARB = 0x900C;
    public const SAMPLER_CUBE_MAP_ARRAY_SHADOW_ARB = 0x900D;
    public const INT_SAMPLER_CUBE_MAP_ARRAY_ARB = 0x900E;
    public const UNSIGNED_INT_SAMPLER_CUBE_MAP_ARRAY_ARB = 0x900F;
    public const ARB_texture_filter_anisotropic = 1;
    public const ARB_texture_filter_minmax = 1;
    public const TEXTURE_REDUCTION_MODE_ARB = 0x9366;
    public const WEIGHTED_AVERAGE_ARB = 0x9367;
    public const ARB_texture_gather = 1;
    public const MIN_PROGRAM_TEXTURE_GATHER_OFFSET_ARB = 0x8E5E;
    public const MAX_PROGRAM_TEXTURE_GATHER_OFFSET_ARB = 0x8E5F;
    public const MAX_PROGRAM_TEXTURE_GATHER_COMPONENTS_ARB = 0x8F9F;
    public const ARB_texture_mirror_clamp_to_edge = 1;
    public const ARB_texture_mirrored_repeat = 1;
    public const MIRRORED_REPEAT_ARB = 0x8370;
    public const ARB_texture_multisample = 1;
    public const ARB_texture_non_power_of_two = 1;
    public const ARB_texture_query_levels = 1;
    public const ARB_texture_query_lod = 1;
    public const ARB_texture_rg = 1;
    public const ARB_texture_rgb10_a2ui = 1;
    public const ARB_texture_stencil8 = 1;
    public const ARB_texture_storage = 1;
    public const ARB_texture_storage_multisample = 1;
    public const ARB_texture_swizzle = 1;
    public const ARB_texture_view = 1;
    public const ARB_timer_query = 1;
    public const ARB_transform_feedback2 = 1;
    public const ARB_transform_feedback3 = 1;
    public const ARB_transform_feedback_instanced = 1;
    public const ARB_transform_feedback_overflow_query = 1;
    public const TRANSFORM_FEEDBACK_OVERFLOW_ARB = 0x82EC;
    public const TRANSFORM_FEEDBACK_STREAM_OVERFLOW_ARB = 0x82ED;
    public const ARB_uniform_buffer_object = 1;
    public const ARB_vertex_array_bgra = 1;
    public const ARB_vertex_array_object = 1;
    public const ARB_vertex_attrib_64bit = 1;
    public const ARB_vertex_attrib_binding = 1;
    public const ARB_vertex_type_10f_11f_11f_rev = 1;
    public const ARB_vertex_type_2_10_10_10_rev = 1;
    public const ARB_viewport_array = 1;
    public const KHR_blend_equation_advanced = 1;
    public const MULTIPLY_KHR = 0x9294;
    public const SCREEN_KHR = 0x9295;
    public const OVERLAY_KHR = 0x9296;
    public const DARKEN_KHR = 0x9297;
    public const LIGHTEN_KHR = 0x9298;
    public const COLORDODGE_KHR = 0x9299;
    public const COLORBURN_KHR = 0x929A;
    public const HARDLIGHT_KHR = 0x929B;
    public const SOFTLIGHT_KHR = 0x929C;
    public const DIFFERENCE_KHR = 0x929E;
    public const EXCLUSION_KHR = 0x92A0;
    public const HSL_HUE_KHR = 0x92AD;
    public const HSL_SATURATION_KHR = 0x92AE;
    public const HSL_COLOR_KHR = 0x92AF;
    public const HSL_LUMINOSITY_KHR = 0x92B0;
    public const KHR_blend_equation_advanced_coherent = 1;
    public const BLEND_ADVANCED_COHERENT_KHR = 0x9285;
    public const KHR_context_flush_control = 1;
    public const KHR_debug = 1;
    public const KHR_no_error = 1;
    public const CONTEXT_FLAG_NO_ERROR_BIT_KHR = 0x00000008;
    public const KHR_parallel_shader_compile = 1;
    public const MAX_SHADER_COMPILER_THREADS_KHR = 0x91B0;
    public const COMPLETION_STATUS_KHR = 0x91B1;
    public const KHR_robust_buffer_access_behavior = 1;
    public const KHR_robustness = 1;
    public const CONTEXT_ROBUST_ACCESS = 0x90F3;
    public const KHR_shader_subgroup = 1;
    public const SUBGROUP_SIZE_KHR = 0x9532;
    public const SUBGROUP_SUPPORTED_STAGES_KHR = 0x9533;
    public const SUBGROUP_SUPPORTED_FEATURES_KHR = 0x9534;
    public const SUBGROUP_QUAD_ALL_STAGES_KHR = 0x9535;
    public const SUBGROUP_FEATURE_BASIC_BIT_KHR = 0x00000001;
    public const SUBGROUP_FEATURE_VOTE_BIT_KHR = 0x00000002;
    public const SUBGROUP_FEATURE_ARITHMETIC_BIT_KHR = 0x00000004;
    public const SUBGROUP_FEATURE_BALLOT_BIT_KHR = 0x00000008;
    public const SUBGROUP_FEATURE_SHUFFLE_BIT_KHR = 0x00000010;
    public const SUBGROUP_FEATURE_SHUFFLE_RELATIVE_BIT_KHR = 0x00000020;
    public const SUBGROUP_FEATURE_CLUSTERED_BIT_KHR = 0x00000040;
    public const SUBGROUP_FEATURE_QUAD_BIT_KHR = 0x00000080;
    public const KHR_texture_compression_astc_hdr = 1;
    public const COMPRESSED_RGBA_ASTC_4x4_KHR = 0x93B0;
    public const COMPRESSED_RGBA_ASTC_5x4_KHR = 0x93B1;
    public const COMPRESSED_RGBA_ASTC_5x5_KHR = 0x93B2;
    public const COMPRESSED_RGBA_ASTC_6x5_KHR = 0x93B3;
    public const COMPRESSED_RGBA_ASTC_6x6_KHR = 0x93B4;
    public const COMPRESSED_RGBA_ASTC_8x5_KHR = 0x93B5;
    public const COMPRESSED_RGBA_ASTC_8x6_KHR = 0x93B6;
    public const COMPRESSED_RGBA_ASTC_8x8_KHR = 0x93B7;
    public const COMPRESSED_RGBA_ASTC_10x5_KHR = 0x93B8;
    public const COMPRESSED_RGBA_ASTC_10x6_KHR = 0x93B9;
    public const COMPRESSED_RGBA_ASTC_10x8_KHR = 0x93BA;
    public const COMPRESSED_RGBA_ASTC_10x10_KHR = 0x93BB;
    public const COMPRESSED_RGBA_ASTC_12x10_KHR = 0x93BC;
    public const COMPRESSED_RGBA_ASTC_12x12_KHR = 0x93BD;
    public const COMPRESSED_SRGB8_ALPHA8_ASTC_4x4_KHR = 0x93D0;
    public const COMPRESSED_SRGB8_ALPHA8_ASTC_5x4_KHR = 0x93D1;
    public const COMPRESSED_SRGB8_ALPHA8_ASTC_5x5_KHR = 0x93D2;
    public const COMPRESSED_SRGB8_ALPHA8_ASTC_6x5_KHR = 0x93D3;
    public const COMPRESSED_SRGB8_ALPHA8_ASTC_6x6_KHR = 0x93D4;
    public const COMPRESSED_SRGB8_ALPHA8_ASTC_8x5_KHR = 0x93D5;
    public const COMPRESSED_SRGB8_ALPHA8_ASTC_8x6_KHR = 0x93D6;
    public const COMPRESSED_SRGB8_ALPHA8_ASTC_8x8_KHR = 0x93D7;
    public const COMPRESSED_SRGB8_ALPHA8_ASTC_10x5_KHR = 0x93D8;
    public const COMPRESSED_SRGB8_ALPHA8_ASTC_10x6_KHR = 0x93D9;
    public const COMPRESSED_SRGB8_ALPHA8_ASTC_10x8_KHR = 0x93DA;
    public const COMPRESSED_SRGB8_ALPHA8_ASTC_10x10_KHR = 0x93DB;
    public const COMPRESSED_SRGB8_ALPHA8_ASTC_12x10_KHR = 0x93DC;
    public const COMPRESSED_SRGB8_ALPHA8_ASTC_12x12_KHR = 0x93DD;
    public const KHR_texture_compression_astc_ldr = 1;
    public const KHR_texture_compression_astc_sliced_3d = 1;
    public const AMD_framebuffer_multisample_advanced = 1;
    public const RENDERBUFFER_STORAGE_SAMPLES_AMD = 0x91B2;
    public const MAX_COLOR_FRAMEBUFFER_SAMPLES_AMD = 0x91B3;
    public const MAX_COLOR_FRAMEBUFFER_STORAGE_SAMPLES_AMD = 0x91B4;
    public const MAX_DEPTH_STENCIL_FRAMEBUFFER_SAMPLES_AMD = 0x91B5;
    public const NUM_SUPPORTED_MULTISAMPLE_MODES_AMD = 0x91B6;
    public const SUPPORTED_MULTISAMPLE_MODES_AMD = 0x91B7;
    public const AMD_performance_monitor = 1;
    public const COUNTER_TYPE_AMD = 0x8BC0;
    public const COUNTER_RANGE_AMD = 0x8BC1;
    public const UNSIGNED_INT64_AMD = 0x8BC2;
    public const PERCENTAGE_AMD = 0x8BC3;
    public const PERFMON_RESULT_AVAILABLE_AMD = 0x8BC4;
    public const PERFMON_RESULT_SIZE_AMD = 0x8BC5;
    public const PERFMON_RESULT_AMD = 0x8BC6;
    public const APPLE_rgb_422 = 1;
    public const RGB_422_APPLE = 0x8A1F;
    public const UNSIGNED_SHORT_8_8_APPLE = 0x85BA;
    public const UNSIGNED_SHORT_8_8_REV_APPLE = 0x85BB;
    public const RGB_RAW_422_APPLE = 0x8A51;
    public const EXT_EGL_image_storage = 1;
    public const EXT_EGL_sync = 1;
    public const EXT_debug_label = 1;
    public const PROGRAM_PIPELINE_OBJECT_EXT = 0x8A4F;
    public const PROGRAM_OBJECT_EXT = 0x8B40;
    public const SHADER_OBJECT_EXT = 0x8B48;
    public const BUFFER_OBJECT_EXT = 0x9151;
    public const QUERY_OBJECT_EXT = 0x9153;
    public const VERTEX_ARRAY_OBJECT_EXT = 0x9154;
    public const EXT_debug_marker = 1;
    public const EXT_direct_state_access = 1;
    public const PROGRAM_MATRIX_EXT = 0x8E2D;
    public const TRANSPOSE_PROGRAM_MATRIX_EXT = 0x8E2E;
    public const PROGRAM_MATRIX_STACK_DEPTH_EXT = 0x8E2F;
    public const EXT_draw_instanced = 1;
    public const EXT_multiview_tessellation_geometry_shader = 1;
    public const EXT_multiview_texture_multisample = 1;
    public const EXT_multiview_timer_query = 1;
    public const EXT_polygon_offset_clamp = 1;
    public const POLYGON_OFFSET_CLAMP_EXT = 0x8E1B;
    public const EXT_post_depth_coverage = 1;
    public const EXT_raster_multisample = 1;
    public const RASTER_MULTISAMPLE_EXT = 0x9327;
    public const RASTER_SAMPLES_EXT = 0x9328;
    public const MAX_RASTER_SAMPLES_EXT = 0x9329;
    public const RASTER_FIXED_SAMPLE_LOCATIONS_EXT = 0x932A;
    public const MULTISAMPLE_RASTERIZATION_ALLOWED_EXT = 0x932B;
    public const EFFECTIVE_RASTER_SAMPLES_EXT = 0x932C;
    public const EXT_separate_shader_objects = 1;
    public const ACTIVE_PROGRAM_EXT = 0x8B8D;
    public const EXT_shader_framebuffer_fetch = 1;
    public const FRAGMENT_SHADER_DISCARDS_SAMPLES_EXT = 0x8A52;
    public const EXT_shader_framebuffer_fetch_non_coherent = 1;
    public const EXT_shader_integer_mix = 1;
    public const EXT_texture_compression_s3tc = 1;
    public const COMPRESSED_RGB_S3TC_DXT1_EXT = 0x83F0;
    public const COMPRESSED_RGBA_S3TC_DXT1_EXT = 0x83F1;
    public const COMPRESSED_RGBA_S3TC_DXT3_EXT = 0x83F2;
    public const COMPRESSED_RGBA_S3TC_DXT5_EXT = 0x83F3;
    public const EXT_texture_filter_minmax = 1;
    public const TEXTURE_REDUCTION_MODE_EXT = 0x9366;
    public const WEIGHTED_AVERAGE_EXT = 0x9367;
    public const EXT_texture_sRGB_R8 = 1;
    public const SR8_EXT = 0x8FBD;
    public const EXT_texture_sRGB_RG8 = 1;
    public const SRG8_EXT = 0x8FBE;
    public const EXT_texture_sRGB_decode = 1;
    public const TEXTURE_SRGB_DECODE_EXT = 0x8A48;
    public const DECODE_EXT = 0x8A49;
    public const SKIP_DECODE_EXT = 0x8A4A;
    public const EXT_texture_shadow_lod = 1;
    public const EXT_texture_storage = 1;
    public const TEXTURE_IMMUTABLE_FORMAT_EXT = 0x912F;
    public const ALPHA8_EXT = 0x803C;
    public const LUMINANCE8_EXT = 0x8040;
    public const LUMINANCE8_ALPHA8_EXT = 0x8045;
    public const RGBA32F_EXT = 0x8814;
    public const RGB32F_EXT = 0x8815;
    public const ALPHA32F_EXT = 0x8816;
    public const LUMINANCE32F_EXT = 0x8818;
    public const LUMINANCE_ALPHA32F_EXT = 0x8819;
    public const RGBA16F_EXT = 0x881A;
    public const RGB16F_EXT = 0x881B;
    public const ALPHA16F_EXT = 0x881C;
    public const LUMINANCE16F_EXT = 0x881E;
    public const LUMINANCE_ALPHA16F_EXT = 0x881F;
    public const RGB10_A2_EXT = 0x8059;
    public const RGB10_EXT = 0x8052;
    public const BGRA8_EXT = 0x93A1;
    public const R8_EXT = 0x8229;
    public const RG8_EXT = 0x822B;
    public const R32F_EXT = 0x822E;
    public const RG32F_EXT = 0x8230;
    public const R16F_EXT = 0x822D;
    public const RG16F_EXT = 0x822F;
    public const EXT_window_rectangles = 1;
    public const INCLUSIVE_EXT = 0x8F10;
    public const EXCLUSIVE_EXT = 0x8F11;
    public const WINDOW_RECTANGLE_EXT = 0x8F12;
    public const WINDOW_RECTANGLE_MODE_EXT = 0x8F13;
    public const MAX_WINDOW_RECTANGLES_EXT = 0x8F14;
    public const NUM_WINDOW_RECTANGLES_EXT = 0x8F15;
    public const INTEL_blackhole_render = 1;
    public const BLACKHOLE_RENDER_INTEL = 0x83FC;
    public const INTEL_conservative_rasterization = 1;
    public const CONSERVATIVE_RASTERIZATION_INTEL = 0x83FE;
    public const INTEL_framebuffer_CMAA = 1;
    public const INTEL_performance_query = 1;
    public const PERFQUERY_SINGLE_CONTEXT_INTEL = 0x00000000;
    public const PERFQUERY_GLOBAL_CONTEXT_INTEL = 0x00000001;
    public const PERFQUERY_WAIT_INTEL = 0x83FB;
    public const PERFQUERY_FLUSH_INTEL = 0x83FA;
    public const PERFQUERY_DONOT_FLUSH_INTEL = 0x83F9;
    public const PERFQUERY_COUNTER_EVENT_INTEL = 0x94F0;
    public const PERFQUERY_COUNTER_DURATION_NORM_INTEL = 0x94F1;
    public const PERFQUERY_COUNTER_DURATION_RAW_INTEL = 0x94F2;
    public const PERFQUERY_COUNTER_THROUGHPUT_INTEL = 0x94F3;
    public const PERFQUERY_COUNTER_RAW_INTEL = 0x94F4;
    public const PERFQUERY_COUNTER_TIMESTAMP_INTEL = 0x94F5;
    public const PERFQUERY_COUNTER_DATA_UINT32_INTEL = 0x94F8;
    public const PERFQUERY_COUNTER_DATA_UINT64_INTEL = 0x94F9;
    public const PERFQUERY_COUNTER_DATA_FLOAT_INTEL = 0x94FA;
    public const PERFQUERY_COUNTER_DATA_DOUBLE_INTEL = 0x94FB;
    public const PERFQUERY_COUNTER_DATA_BOOL32_INTEL = 0x94FC;
    public const PERFQUERY_QUERY_NAME_LENGTH_MAX_INTEL = 0x94FD;
    public const PERFQUERY_COUNTER_NAME_LENGTH_MAX_INTEL = 0x94FE;
    public const PERFQUERY_COUNTER_DESC_LENGTH_MAX_INTEL = 0x94FF;
    public const PERFQUERY_GPA_EXTENDED_COUNTERS_INTEL = 0x9500;
    public const MESA_framebuffer_flip_x = 1;
    public const FRAMEBUFFER_FLIP_X_MESA = 0x8BBC;
    public const MESA_framebuffer_flip_y = 1;
    public const FRAMEBUFFER_FLIP_Y_MESA = 0x8BBB;
    public const MESA_framebuffer_swap_xy = 1;
    public const FRAMEBUFFER_SWAP_XY_MESA = 0x8BBD;
    public const NV_bindless_multi_draw_indirect = 1;
    public const NV_bindless_multi_draw_indirect_count = 1;
    public const NV_bindless_texture = 1;
    public const NV_blend_equation_advanced = 1;
    public const BLEND_OVERLAP_NV = 0x9281;
    public const BLEND_PREMULTIPLIED_SRC_NV = 0x9280;
    public const BLUE_NV = 0x1905;
    public const COLORBURN_NV = 0x929A;
    public const COLORDODGE_NV = 0x9299;
    public const CONJOINT_NV = 0x9284;
    public const CONTRAST_NV = 0x92A1;
    public const DARKEN_NV = 0x9297;
    public const DIFFERENCE_NV = 0x929E;
    public const DISJOINT_NV = 0x9283;
    public const DST_ATOP_NV = 0x928F;
    public const DST_IN_NV = 0x928B;
    public const DST_NV = 0x9287;
    public const DST_OUT_NV = 0x928D;
    public const DST_OVER_NV = 0x9289;
    public const EXCLUSION_NV = 0x92A0;
    public const GREEN_NV = 0x1904;
    public const HARDLIGHT_NV = 0x929B;
    public const HARDMIX_NV = 0x92A9;
    public const HSL_COLOR_NV = 0x92AF;
    public const HSL_HUE_NV = 0x92AD;
    public const HSL_LUMINOSITY_NV = 0x92B0;
    public const HSL_SATURATION_NV = 0x92AE;
    public const INVERT_OVG_NV = 0x92B4;
    public const INVERT_RGB_NV = 0x92A3;
    public const LIGHTEN_NV = 0x9298;
    public const LINEARBURN_NV = 0x92A5;
    public const LINEARDODGE_NV = 0x92A4;
    public const LINEARLIGHT_NV = 0x92A7;
    public const MINUS_CLAMPED_NV = 0x92B3;
    public const MINUS_NV = 0x929F;
    public const MULTIPLY_NV = 0x9294;
    public const OVERLAY_NV = 0x9296;
    public const PINLIGHT_NV = 0x92A8;
    public const PLUS_CLAMPED_ALPHA_NV = 0x92B2;
    public const PLUS_CLAMPED_NV = 0x92B1;
    public const PLUS_DARKER_NV = 0x9292;
    public const PLUS_NV = 0x9291;
    public const RED_NV = 0x1903;
    public const SCREEN_NV = 0x9295;
    public const SOFTLIGHT_NV = 0x929C;
    public const SRC_ATOP_NV = 0x928E;
    public const SRC_IN_NV = 0x928A;
    public const SRC_NV = 0x9286;
    public const SRC_OUT_NV = 0x928C;
    public const SRC_OVER_NV = 0x9288;
    public const UNCORRELATED_NV = 0x9282;
    public const VIVIDLIGHT_NV = 0x92A6;
    public const XOR_NV = 0x1506;
    public const NV_blend_equation_advanced_coherent = 1;
    public const BLEND_ADVANCED_COHERENT_NV = 0x9285;
    public const NV_blend_minmax_factor = 1;
    public const FACTOR_MIN_AMD = 0x901C;
    public const FACTOR_MAX_AMD = 0x901D;
    public const NV_clip_space_w_scaling = 1;
    public const VIEWPORT_POSITION_W_SCALE_NV = 0x937C;
    public const VIEWPORT_POSITION_W_SCALE_X_COEFF_NV = 0x937D;
    public const VIEWPORT_POSITION_W_SCALE_Y_COEFF_NV = 0x937E;
    public const NV_command_list = 1;
    public const TERMINATE_SEQUENCE_COMMAND_NV = 0x0000;
    public const NOP_COMMAND_NV = 0x0001;
    public const DRAW_ELEMENTS_COMMAND_NV = 0x0002;
    public const DRAW_ARRAYS_COMMAND_NV = 0x0003;
    public const DRAW_ELEMENTS_STRIP_COMMAND_NV = 0x0004;
    public const DRAW_ARRAYS_STRIP_COMMAND_NV = 0x0005;
    public const DRAW_ELEMENTS_INSTANCED_COMMAND_NV = 0x0006;
    public const DRAW_ARRAYS_INSTANCED_COMMAND_NV = 0x0007;
    public const ELEMENT_ADDRESS_COMMAND_NV = 0x0008;
    public const ATTRIBUTE_ADDRESS_COMMAND_NV = 0x0009;
    public const UNIFORM_ADDRESS_COMMAND_NV = 0x000A;
    public const BLEND_COLOR_COMMAND_NV = 0x000B;
    public const STENCIL_REF_COMMAND_NV = 0x000C;
    public const LINE_WIDTH_COMMAND_NV = 0x000D;
    public const POLYGON_OFFSET_COMMAND_NV = 0x000E;
    public const ALPHA_REF_COMMAND_NV = 0x000F;
    public const VIEWPORT_COMMAND_NV = 0x0010;
    public const SCISSOR_COMMAND_NV = 0x0011;
    public const FRONT_FACE_COMMAND_NV = 0x0012;
    public const NV_compute_shader_derivatives = 1;
    public const NV_conditional_render = 1;
    public const QUERY_WAIT_NV = 0x8E13;
    public const QUERY_NO_WAIT_NV = 0x8E14;
    public const QUERY_BY_REGION_WAIT_NV = 0x8E15;
    public const QUERY_BY_REGION_NO_WAIT_NV = 0x8E16;
    public const NV_conservative_raster = 1;
    public const CONSERVATIVE_RASTERIZATION_NV = 0x9346;
    public const SUBPIXEL_PRECISION_BIAS_X_BITS_NV = 0x9347;
    public const SUBPIXEL_PRECISION_BIAS_Y_BITS_NV = 0x9348;
    public const MAX_SUBPIXEL_PRECISION_BIAS_BITS_NV = 0x9349;
    public const NV_conservative_raster_dilate = 1;
    public const CONSERVATIVE_RASTER_DILATE_NV = 0x9379;
    public const CONSERVATIVE_RASTER_DILATE_RANGE_NV = 0x937A;
    public const CONSERVATIVE_RASTER_DILATE_GRANULARITY_NV = 0x937B;
    public const NV_conservative_raster_pre_snap = 1;
    public const CONSERVATIVE_RASTER_MODE_PRE_SNAP_NV = 0x9550;
    public const NV_conservative_raster_pre_snap_triangles = 1;
    public const CONSERVATIVE_RASTER_MODE_NV = 0x954D;
    public const CONSERVATIVE_RASTER_MODE_POST_SNAP_NV = 0x954E;
    public const CONSERVATIVE_RASTER_MODE_PRE_SNAP_TRIANGLES_NV = 0x954F;
    public const NV_conservative_raster_underestimation = 1;
    public const NV_depth_buffer_float = 1;
    public const DEPTH_COMPONENT32F_NV = 0x8DAB;
    public const DEPTH32F_STENCIL8_NV = 0x8DAC;
    public const FLOAT_32_UNSIGNED_INT_24_8_REV_NV = 0x8DAD;
    public const DEPTH_BUFFER_FLOAT_MODE_NV = 0x8DAF;
    public const NV_draw_vulkan_image = 1;
    public const NV_fill_rectangle = 1;
    public const FILL_RECTANGLE_NV = 0x933C;
    public const NV_fragment_coverage_to_color = 1;
    public const FRAGMENT_COVERAGE_TO_COLOR_NV = 0x92DD;
    public const FRAGMENT_COVERAGE_COLOR_NV = 0x92DE;
    public const NV_fragment_shader_barycentric = 1;
    public const NV_fragment_shader_interlock = 1;
    public const NV_framebuffer_mixed_samples = 1;
    public const COVERAGE_MODULATION_TABLE_NV = 0x9331;
    public const COLOR_SAMPLES_NV = 0x8E20;
    public const DEPTH_SAMPLES_NV = 0x932D;
    public const STENCIL_SAMPLES_NV = 0x932E;
    public const MIXED_DEPTH_SAMPLES_SUPPORTED_NV = 0x932F;
    public const MIXED_STENCIL_SAMPLES_SUPPORTED_NV = 0x9330;
    public const COVERAGE_MODULATION_NV = 0x9332;
    public const COVERAGE_MODULATION_TABLE_SIZE_NV = 0x9333;
    public const NV_framebuffer_multisample_coverage = 1;
    public const RENDERBUFFER_COVERAGE_SAMPLES_NV = 0x8CAB;
    public const RENDERBUFFER_COLOR_SAMPLES_NV = 0x8E10;
    public const MAX_MULTISAMPLE_COVERAGE_MODES_NV = 0x8E11;
    public const MULTISAMPLE_COVERAGE_MODES_NV = 0x8E12;
    public const NV_geometry_shader_passthrough = 1;
    public const NV_gpu_shader5 = 1;
    public const INT64_NV = 0x140E;
    public const UNSIGNED_INT64_NV = 0x140F;
    public const INT8_NV = 0x8FE0;
    public const INT8_VEC2_NV = 0x8FE1;
    public const INT8_VEC3_NV = 0x8FE2;
    public const INT8_VEC4_NV = 0x8FE3;
    public const INT16_NV = 0x8FE4;
    public const INT16_VEC2_NV = 0x8FE5;
    public const INT16_VEC3_NV = 0x8FE6;
    public const INT16_VEC4_NV = 0x8FE7;
    public const INT64_VEC2_NV = 0x8FE9;
    public const INT64_VEC3_NV = 0x8FEA;
    public const INT64_VEC4_NV = 0x8FEB;
    public const UNSIGNED_INT8_NV = 0x8FEC;
    public const UNSIGNED_INT8_VEC2_NV = 0x8FED;
    public const UNSIGNED_INT8_VEC3_NV = 0x8FEE;
    public const UNSIGNED_INT8_VEC4_NV = 0x8FEF;
    public const UNSIGNED_INT16_NV = 0x8FF0;
    public const UNSIGNED_INT16_VEC2_NV = 0x8FF1;
    public const UNSIGNED_INT16_VEC3_NV = 0x8FF2;
    public const UNSIGNED_INT16_VEC4_NV = 0x8FF3;
    public const UNSIGNED_INT64_VEC2_NV = 0x8FF5;
    public const UNSIGNED_INT64_VEC3_NV = 0x8FF6;
    public const UNSIGNED_INT64_VEC4_NV = 0x8FF7;
    public const FLOAT16_NV = 0x8FF8;
    public const FLOAT16_VEC2_NV = 0x8FF9;
    public const FLOAT16_VEC3_NV = 0x8FFA;
    public const FLOAT16_VEC4_NV = 0x8FFB;
    public const NV_internalformat_sample_query = 1;
    public const MULTISAMPLES_NV = 0x9371;
    public const SUPERSAMPLE_SCALE_X_NV = 0x9372;
    public const SUPERSAMPLE_SCALE_Y_NV = 0x9373;
    public const CONFORMANT_NV = 0x9374;
    public const NV_memory_attachment = 1;
    public const ATTACHED_MEMORY_OBJECT_NV = 0x95A4;
    public const ATTACHED_MEMORY_OFFSET_NV = 0x95A5;
    public const MEMORY_ATTACHABLE_ALIGNMENT_NV = 0x95A6;
    public const MEMORY_ATTACHABLE_SIZE_NV = 0x95A7;
    public const MEMORY_ATTACHABLE_NV = 0x95A8;
    public const DETACHED_MEMORY_INCARNATION_NV = 0x95A9;
    public const DETACHED_TEXTURES_NV = 0x95AA;
    public const DETACHED_BUFFERS_NV = 0x95AB;
    public const MAX_DETACHED_TEXTURES_NV = 0x95AC;
    public const MAX_DETACHED_BUFFERS_NV = 0x95AD;
    public const NV_memory_object_sparse = 1;
    public const NV_mesh_shader = 1;
    public const MESH_SHADER_NV = 0x9559;
    public const TASK_SHADER_NV = 0x955A;
    public const MAX_MESH_UNIFORM_BLOCKS_NV = 0x8E60;
    public const MAX_MESH_TEXTURE_IMAGE_UNITS_NV = 0x8E61;
    public const MAX_MESH_IMAGE_UNIFORMS_NV = 0x8E62;
    public const MAX_MESH_UNIFORM_COMPONENTS_NV = 0x8E63;
    public const MAX_MESH_ATOMIC_COUNTER_BUFFERS_NV = 0x8E64;
    public const MAX_MESH_ATOMIC_COUNTERS_NV = 0x8E65;
    public const MAX_MESH_SHADER_STORAGE_BLOCKS_NV = 0x8E66;
    public const MAX_COMBINED_MESH_UNIFORM_COMPONENTS_NV = 0x8E67;
    public const MAX_TASK_UNIFORM_BLOCKS_NV = 0x8E68;
    public const MAX_TASK_TEXTURE_IMAGE_UNITS_NV = 0x8E69;
    public const MAX_TASK_IMAGE_UNIFORMS_NV = 0x8E6A;
    public const MAX_TASK_UNIFORM_COMPONENTS_NV = 0x8E6B;
    public const MAX_TASK_ATOMIC_COUNTER_BUFFERS_NV = 0x8E6C;
    public const MAX_TASK_ATOMIC_COUNTERS_NV = 0x8E6D;
    public const MAX_TASK_SHADER_STORAGE_BLOCKS_NV = 0x8E6E;
    public const MAX_COMBINED_TASK_UNIFORM_COMPONENTS_NV = 0x8E6F;
    public const MAX_MESH_WORK_GROUP_INVOCATIONS_NV = 0x95A2;
    public const MAX_TASK_WORK_GROUP_INVOCATIONS_NV = 0x95A3;
    public const MAX_MESH_TOTAL_MEMORY_SIZE_NV = 0x9536;
    public const MAX_TASK_TOTAL_MEMORY_SIZE_NV = 0x9537;
    public const MAX_MESH_OUTPUT_VERTICES_NV = 0x9538;
    public const MAX_MESH_OUTPUT_PRIMITIVES_NV = 0x9539;
    public const MAX_TASK_OUTPUT_COUNT_NV = 0x953A;
    public const MAX_DRAW_MESH_TASKS_COUNT_NV = 0x953D;
    public const MAX_MESH_VIEWS_NV = 0x9557;
    public const MESH_OUTPUT_PER_VERTEX_GRANULARITY_NV = 0x92DF;
    public const MESH_OUTPUT_PER_PRIMITIVE_GRANULARITY_NV = 0x9543;
    public const MAX_MESH_WORK_GROUP_SIZE_NV = 0x953B;
    public const MAX_TASK_WORK_GROUP_SIZE_NV = 0x953C;
    public const MESH_WORK_GROUP_SIZE_NV = 0x953E;
    public const TASK_WORK_GROUP_SIZE_NV = 0x953F;
    public const MESH_VERTICES_OUT_NV = 0x9579;
    public const MESH_PRIMITIVES_OUT_NV = 0x957A;
    public const MESH_OUTPUT_TYPE_NV = 0x957B;
    public const UNIFORM_BLOCK_REFERENCED_BY_MESH_SHADER_NV = 0x959C;
    public const UNIFORM_BLOCK_REFERENCED_BY_TASK_SHADER_NV = 0x959D;
    public const REFERENCED_BY_MESH_SHADER_NV = 0x95A0;
    public const REFERENCED_BY_TASK_SHADER_NV = 0x95A1;
    public const MESH_SHADER_BIT_NV = 0x00000040;
    public const TASK_SHADER_BIT_NV = 0x00000080;
    public const MESH_SUBROUTINE_NV = 0x957C;
    public const TASK_SUBROUTINE_NV = 0x957D;
    public const MESH_SUBROUTINE_UNIFORM_NV = 0x957E;
    public const TASK_SUBROUTINE_UNIFORM_NV = 0x957F;
    public const ATOMIC_COUNTER_BUFFER_REFERENCED_BY_MESH_SHADER_NV = 0x959E;
    public const ATOMIC_COUNTER_BUFFER_REFERENCED_BY_TASK_SHADER_NV = 0x959F;
    public const NV_path_rendering = 1;
    public const PATH_FORMAT_SVG_NV = 0x9070;
    public const PATH_FORMAT_PS_NV = 0x9071;
    public const STANDARD_FONT_NAME_NV = 0x9072;
    public const SYSTEM_FONT_NAME_NV = 0x9073;
    public const FILE_NAME_NV = 0x9074;
    public const PATH_STROKE_WIDTH_NV = 0x9075;
    public const PATH_END_CAPS_NV = 0x9076;
    public const PATH_INITIAL_END_CAP_NV = 0x9077;
    public const PATH_TERMINAL_END_CAP_NV = 0x9078;
    public const PATH_JOIN_STYLE_NV = 0x9079;
    public const PATH_MITER_LIMIT_NV = 0x907A;
    public const PATH_DASH_CAPS_NV = 0x907B;
    public const PATH_INITIAL_DASH_CAP_NV = 0x907C;
    public const PATH_TERMINAL_DASH_CAP_NV = 0x907D;
    public const PATH_DASH_OFFSET_NV = 0x907E;
    public const PATH_CLIENT_LENGTH_NV = 0x907F;
    public const PATH_FILL_MODE_NV = 0x9080;
    public const PATH_FILL_MASK_NV = 0x9081;
    public const PATH_FILL_COVER_MODE_NV = 0x9082;
    public const PATH_STROKE_COVER_MODE_NV = 0x9083;
    public const PATH_STROKE_MASK_NV = 0x9084;
    public const COUNT_UP_NV = 0x9088;
    public const COUNT_DOWN_NV = 0x9089;
    public const PATH_OBJECT_BOUNDING_BOX_NV = 0x908A;
    public const CONVEX_HULL_NV = 0x908B;
    public const BOUNDING_BOX_NV = 0x908D;
    public const TRANSLATE_X_NV = 0x908E;
    public const TRANSLATE_Y_NV = 0x908F;
    public const TRANSLATE_2D_NV = 0x9090;
    public const TRANSLATE_3D_NV = 0x9091;
    public const AFFINE_2D_NV = 0x9092;
    public const AFFINE_3D_NV = 0x9094;
    public const TRANSPOSE_AFFINE_2D_NV = 0x9096;
    public const TRANSPOSE_AFFINE_3D_NV = 0x9098;
    public const UTF8_NV = 0x909A;
    public const UTF16_NV = 0x909B;
    public const BOUNDING_BOX_OF_BOUNDING_BOXES_NV = 0x909C;
    public const PATH_COMMAND_COUNT_NV = 0x909D;
    public const PATH_COORD_COUNT_NV = 0x909E;
    public const PATH_DASH_ARRAY_COUNT_NV = 0x909F;
    public const PATH_COMPUTED_LENGTH_NV = 0x90A0;
    public const PATH_FILL_BOUNDING_BOX_NV = 0x90A1;
    public const PATH_STROKE_BOUNDING_BOX_NV = 0x90A2;
    public const SQUARE_NV = 0x90A3;
    public const ROUND_NV = 0x90A4;
    public const TRIANGULAR_NV = 0x90A5;
    public const BEVEL_NV = 0x90A6;
    public const MITER_REVERT_NV = 0x90A7;
    public const MITER_TRUNCATE_NV = 0x90A8;
    public const SKIP_MISSING_GLYPH_NV = 0x90A9;
    public const USE_MISSING_GLYPH_NV = 0x90AA;
    public const PATH_ERROR_POSITION_NV = 0x90AB;
    public const ACCUM_ADJACENT_PAIRS_NV = 0x90AD;
    public const ADJACENT_PAIRS_NV = 0x90AE;
    public const FIRST_TO_REST_NV = 0x90AF;
    public const PATH_GEN_MODE_NV = 0x90B0;
    public const PATH_GEN_COEFF_NV = 0x90B1;
    public const PATH_GEN_COMPONENTS_NV = 0x90B3;
    public const PATH_STENCIL_FUNC_NV = 0x90B7;
    public const PATH_STENCIL_REF_NV = 0x90B8;
    public const PATH_STENCIL_VALUE_MASK_NV = 0x90B9;
    public const PATH_STENCIL_DEPTH_OFFSET_FACTOR_NV = 0x90BD;
    public const PATH_STENCIL_DEPTH_OFFSET_UNITS_NV = 0x90BE;
    public const PATH_COVER_DEPTH_FUNC_NV = 0x90BF;
    public const PATH_DASH_OFFSET_RESET_NV = 0x90B4;
    public const MOVE_TO_RESETS_NV = 0x90B5;
    public const MOVE_TO_CONTINUES_NV = 0x90B6;
    public const CLOSE_PATH_NV = 0x00;
    public const MOVE_TO_NV = 0x02;
    public const RELATIVE_MOVE_TO_NV = 0x03;
    public const LINE_TO_NV = 0x04;
    public const RELATIVE_LINE_TO_NV = 0x05;
    public const HORIZONTAL_LINE_TO_NV = 0x06;
    public const RELATIVE_HORIZONTAL_LINE_TO_NV = 0x07;
    public const VERTICAL_LINE_TO_NV = 0x08;
    public const RELATIVE_VERTICAL_LINE_TO_NV = 0x09;
    public const QUADRATIC_CURVE_TO_NV = 0x0A;
    public const RELATIVE_QUADRATIC_CURVE_TO_NV = 0x0B;
    public const CUBIC_CURVE_TO_NV = 0x0C;
    public const RELATIVE_CUBIC_CURVE_TO_NV = 0x0D;
    public const SMOOTH_QUADRATIC_CURVE_TO_NV = 0x0E;
    public const RELATIVE_SMOOTH_QUADRATIC_CURVE_TO_NV = 0x0F;
    public const SMOOTH_CUBIC_CURVE_TO_NV = 0x10;
    public const RELATIVE_SMOOTH_CUBIC_CURVE_TO_NV = 0x11;
    public const SMALL_CCW_ARC_TO_NV = 0x12;
    public const RELATIVE_SMALL_CCW_ARC_TO_NV = 0x13;
    public const SMALL_CW_ARC_TO_NV = 0x14;
    public const RELATIVE_SMALL_CW_ARC_TO_NV = 0x15;
    public const LARGE_CCW_ARC_TO_NV = 0x16;
    public const RELATIVE_LARGE_CCW_ARC_TO_NV = 0x17;
    public const LARGE_CW_ARC_TO_NV = 0x18;
    public const RELATIVE_LARGE_CW_ARC_TO_NV = 0x19;
    public const RESTART_PATH_NV = 0xF0;
    public const DUP_FIRST_CUBIC_CURVE_TO_NV = 0xF2;
    public const DUP_LAST_CUBIC_CURVE_TO_NV = 0xF4;
    public const RECT_NV = 0xF6;
    public const CIRCULAR_CCW_ARC_TO_NV = 0xF8;
    public const CIRCULAR_CW_ARC_TO_NV = 0xFA;
    public const CIRCULAR_TANGENT_ARC_TO_NV = 0xFC;
    public const ARC_TO_NV = 0xFE;
    public const RELATIVE_ARC_TO_NV = 0xFF;
    public const BOLD_BIT_NV = 0x01;
    public const ITALIC_BIT_NV = 0x02;
    public const GLYPH_WIDTH_BIT_NV = 0x01;
    public const GLYPH_HEIGHT_BIT_NV = 0x02;
    public const GLYPH_HORIZONTAL_BEARING_X_BIT_NV = 0x04;
    public const GLYPH_HORIZONTAL_BEARING_Y_BIT_NV = 0x08;
    public const GLYPH_HORIZONTAL_BEARING_ADVANCE_BIT_NV = 0x10;
    public const GLYPH_VERTICAL_BEARING_X_BIT_NV = 0x20;
    public const GLYPH_VERTICAL_BEARING_Y_BIT_NV = 0x40;
    public const GLYPH_VERTICAL_BEARING_ADVANCE_BIT_NV = 0x80;
    public const GLYPH_HAS_KERNING_BIT_NV = 0x100;
    public const FONT_X_MIN_BOUNDS_BIT_NV = 0x00010000;
    public const FONT_Y_MIN_BOUNDS_BIT_NV = 0x00020000;
    public const FONT_X_MAX_BOUNDS_BIT_NV = 0x00040000;
    public const FONT_Y_MAX_BOUNDS_BIT_NV = 0x00080000;
    public const FONT_UNITS_PER_EM_BIT_NV = 0x00100000;
    public const FONT_ASCENDER_BIT_NV = 0x00200000;
    public const FONT_DESCENDER_BIT_NV = 0x00400000;
    public const FONT_HEIGHT_BIT_NV = 0x00800000;
    public const FONT_MAX_ADVANCE_WIDTH_BIT_NV = 0x01000000;
    public const FONT_MAX_ADVANCE_HEIGHT_BIT_NV = 0x02000000;
    public const FONT_UNDERLINE_POSITION_BIT_NV = 0x04000000;
    public const FONT_UNDERLINE_THICKNESS_BIT_NV = 0x08000000;
    public const FONT_HAS_KERNING_BIT_NV = 0x10000000;
    public const ROUNDED_RECT_NV = 0xE8;
    public const RELATIVE_ROUNDED_RECT_NV = 0xE9;
    public const ROUNDED_RECT2_NV = 0xEA;
    public const RELATIVE_ROUNDED_RECT2_NV = 0xEB;
    public const ROUNDED_RECT4_NV = 0xEC;
    public const RELATIVE_ROUNDED_RECT4_NV = 0xED;
    public const ROUNDED_RECT8_NV = 0xEE;
    public const RELATIVE_ROUNDED_RECT8_NV = 0xEF;
    public const RELATIVE_RECT_NV = 0xF7;
    public const FONT_GLYPHS_AVAILABLE_NV = 0x9368;
    public const FONT_TARGET_UNAVAILABLE_NV = 0x9369;
    public const FONT_UNAVAILABLE_NV = 0x936A;
    public const FONT_UNINTELLIGIBLE_NV = 0x936B;
    public const CONIC_CURVE_TO_NV = 0x1A;
    public const RELATIVE_CONIC_CURVE_TO_NV = 0x1B;
    public const FONT_NUM_GLYPH_INDICES_BIT_NV = 0x20000000;
    public const STANDARD_FONT_FORMAT_NV = 0x936C;
    public const PATH_PROJECTION_NV = 0x1701;
    public const PATH_MODELVIEW_NV = 0x1700;
    public const PATH_MODELVIEW_STACK_DEPTH_NV = 0x0BA3;
    public const PATH_MODELVIEW_MATRIX_NV = 0x0BA6;
    public const PATH_MAX_MODELVIEW_STACK_DEPTH_NV = 0x0D36;
    public const PATH_TRANSPOSE_MODELVIEW_MATRIX_NV = 0x84E3;
    public const PATH_PROJECTION_STACK_DEPTH_NV = 0x0BA4;
    public const PATH_PROJECTION_MATRIX_NV = 0x0BA7;
    public const PATH_MAX_PROJECTION_STACK_DEPTH_NV = 0x0D38;
    public const PATH_TRANSPOSE_PROJECTION_MATRIX_NV = 0x84E4;
    public const FRAGMENT_INPUT_NV = 0x936D;
    public const NV_path_rendering_shared_edge = 1;
    public const SHARED_EDGE_NV = 0xC0;
    public const NV_primitive_shading_rate = 1;
    public const SHADING_RATE_IMAGE_PER_PRIMITIVE_NV = 0x95B1;
    public const SHADING_RATE_IMAGE_PALETTE_COUNT_NV = 0x95B2;
    public const NV_representative_fragment_test = 1;
    public const REPRESENTATIVE_FRAGMENT_TEST_NV = 0x937F;
    public const NV_sample_locations = 1;
    public const SAMPLE_LOCATION_SUBPIXEL_BITS_NV = 0x933D;
    public const SAMPLE_LOCATION_PIXEL_GRID_WIDTH_NV = 0x933E;
    public const SAMPLE_LOCATION_PIXEL_GRID_HEIGHT_NV = 0x933F;
    public const PROGRAMMABLE_SAMPLE_LOCATION_TABLE_SIZE_NV = 0x9340;
    public const SAMPLE_LOCATION_NV = 0x8E50;
    public const PROGRAMMABLE_SAMPLE_LOCATION_NV = 0x9341;
    public const FRAMEBUFFER_PROGRAMMABLE_SAMPLE_LOCATIONS_NV = 0x9342;
    public const FRAMEBUFFER_SAMPLE_LOCATION_PIXEL_GRID_NV = 0x9343;
    public const NV_sample_mask_override_coverage = 1;
    public const NV_scissor_exclusive = 1;
    public const SCISSOR_TEST_EXCLUSIVE_NV = 0x9555;
    public const SCISSOR_BOX_EXCLUSIVE_NV = 0x9556;
    public const NV_shader_atomic_counters = 1;
    public const NV_shader_atomic_float = 1;
    public const NV_shader_atomic_float64 = 1;
    public const NV_shader_atomic_fp16_vector = 1;
    public const NV_shader_atomic_int64 = 1;
    public const NV_shader_buffer_load = 1;
    public const BUFFER_GPU_ADDRESS_NV = 0x8F1D;
    public const GPU_ADDRESS_NV = 0x8F34;
    public const MAX_SHADER_BUFFER_ADDRESS_NV = 0x8F35;
    public const NV_shader_buffer_store = 1;
    public const SHADER_GLOBAL_ACCESS_BARRIER_BIT_NV = 0x00000010;
    public const NV_shader_subgroup_partitioned = 1;
    public const SUBGROUP_FEATURE_PARTITIONED_BIT_NV = 0x00000100;
    public const NV_shader_texture_footprint = 1;
    public const NV_shader_thread_group = 1;
    public const WARP_SIZE_NV = 0x9339;
    public const WARPS_PER_SM_NV = 0x933A;
    public const SM_COUNT_NV = 0x933B;
    public const NV_shader_thread_shuffle = 1;
    public const NV_shading_rate_image = 1;
    public const SHADING_RATE_IMAGE_NV = 0x9563;
    public const SHADING_RATE_NO_INVOCATIONS_NV = 0x9564;
    public const SHADING_RATE_1_INVOCATION_PER_PIXEL_NV = 0x9565;
    public const SHADING_RATE_1_INVOCATION_PER_1X2_PIXELS_NV = 0x9566;
    public const SHADING_RATE_1_INVOCATION_PER_2X1_PIXELS_NV = 0x9567;
    public const SHADING_RATE_1_INVOCATION_PER_2X2_PIXELS_NV = 0x9568;
    public const SHADING_RATE_1_INVOCATION_PER_2X4_PIXELS_NV = 0x9569;
    public const SHADING_RATE_1_INVOCATION_PER_4X2_PIXELS_NV = 0x956A;
    public const SHADING_RATE_1_INVOCATION_PER_4X4_PIXELS_NV = 0x956B;
    public const SHADING_RATE_2_INVOCATIONS_PER_PIXEL_NV = 0x956C;
    public const SHADING_RATE_4_INVOCATIONS_PER_PIXEL_NV = 0x956D;
    public const SHADING_RATE_8_INVOCATIONS_PER_PIXEL_NV = 0x956E;
    public const SHADING_RATE_16_INVOCATIONS_PER_PIXEL_NV = 0x956F;
    public const SHADING_RATE_IMAGE_BINDING_NV = 0x955B;
    public const SHADING_RATE_IMAGE_TEXEL_WIDTH_NV = 0x955C;
    public const SHADING_RATE_IMAGE_TEXEL_HEIGHT_NV = 0x955D;
    public const SHADING_RATE_IMAGE_PALETTE_SIZE_NV = 0x955E;
    public const MAX_COARSE_FRAGMENT_SAMPLES_NV = 0x955F;
    public const SHADING_RATE_SAMPLE_ORDER_DEFAULT_NV = 0x95AE;
    public const SHADING_RATE_SAMPLE_ORDER_PIXEL_MAJOR_NV = 0x95AF;
    public const SHADING_RATE_SAMPLE_ORDER_SAMPLE_MAJOR_NV = 0x95B0;
    public const NV_stereo_view_rendering = 1;
    public const NV_texture_barrier = 1;
    public const NV_texture_rectangle_compressed = 1;
    public const NV_uniform_buffer_unified_memory = 1;
    public const UNIFORM_BUFFER_UNIFIED_NV = 0x936E;
    public const UNIFORM_BUFFER_ADDRESS_NV = 0x936F;
    public const UNIFORM_BUFFER_LENGTH_NV = 0x9370;
    public const NV_vertex_attrib_integer_64bit = 1;
    public const NV_vertex_buffer_unified_memory = 1;
    public const VERTEX_ATTRIB_ARRAY_UNIFIED_NV = 0x8F1E;
    public const ELEMENT_ARRAY_UNIFIED_NV = 0x8F1F;
    public const VERTEX_ATTRIB_ARRAY_ADDRESS_NV = 0x8F20;
    public const VERTEX_ARRAY_ADDRESS_NV = 0x8F21;
    public const NORMAL_ARRAY_ADDRESS_NV = 0x8F22;
    public const COLOR_ARRAY_ADDRESS_NV = 0x8F23;
    public const INDEX_ARRAY_ADDRESS_NV = 0x8F24;
    public const TEXTURE_COORD_ARRAY_ADDRESS_NV = 0x8F25;
    public const EDGE_FLAG_ARRAY_ADDRESS_NV = 0x8F26;
    public const SECONDARY_COLOR_ARRAY_ADDRESS_NV = 0x8F27;
    public const FOG_COORD_ARRAY_ADDRESS_NV = 0x8F28;
    public const ELEMENT_ARRAY_ADDRESS_NV = 0x8F29;
    public const VERTEX_ATTRIB_ARRAY_LENGTH_NV = 0x8F2A;
    public const VERTEX_ARRAY_LENGTH_NV = 0x8F2B;
    public const NORMAL_ARRAY_LENGTH_NV = 0x8F2C;
    public const COLOR_ARRAY_LENGTH_NV = 0x8F2D;
    public const INDEX_ARRAY_LENGTH_NV = 0x8F2E;
    public const TEXTURE_COORD_ARRAY_LENGTH_NV = 0x8F2F;
    public const EDGE_FLAG_ARRAY_LENGTH_NV = 0x8F30;
    public const SECONDARY_COLOR_ARRAY_LENGTH_NV = 0x8F31;
    public const FOG_COORD_ARRAY_LENGTH_NV = 0x8F32;
    public const ELEMENT_ARRAY_LENGTH_NV = 0x8F33;
    public const DRAW_INDIRECT_UNIFIED_NV = 0x8F40;
    public const DRAW_INDIRECT_ADDRESS_NV = 0x8F41;
    public const DRAW_INDIRECT_LENGTH_NV = 0x8F42;
    public const NV_viewport_array2 = 1;
    public const NV_viewport_swizzle = 1;
    public const VIEWPORT_SWIZZLE_POSITIVE_X_NV = 0x9350;
    public const VIEWPORT_SWIZZLE_NEGATIVE_X_NV = 0x9351;
    public const VIEWPORT_SWIZZLE_POSITIVE_Y_NV = 0x9352;
    public const VIEWPORT_SWIZZLE_NEGATIVE_Y_NV = 0x9353;
    public const VIEWPORT_SWIZZLE_POSITIVE_Z_NV = 0x9354;
    public const VIEWPORT_SWIZZLE_NEGATIVE_Z_NV = 0x9355;
    public const VIEWPORT_SWIZZLE_POSITIVE_W_NV = 0x9356;
    public const VIEWPORT_SWIZZLE_NEGATIVE_W_NV = 0x9357;
    public const VIEWPORT_SWIZZLE_X_NV = 0x9358;
    public const VIEWPORT_SWIZZLE_Y_NV = 0x9359;
    public const VIEWPORT_SWIZZLE_Z_NV = 0x935A;
    public const VIEWPORT_SWIZZLE_W_NV = 0x935B;
    public const OVR_multiview = 1;
    public const FRAMEBUFFER_ATTACHMENT_TEXTURE_NUM_VIEWS_OVR = 0x9630;
    public const FRAMEBUFFER_ATTACHMENT_TEXTURE_BASE_VIEW_INDEX_OVR = 0x9632;
    public const MAX_VIEWS_OVR = 0x9631;
    public const FRAMEBUFFER_INCOMPLETE_VIEW_TARGETS_OVR = 0x9633;
    public const OVR_multiview2 = 1;

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
        return match(\PHP_OS_FAMILY) {
            'Windows' => __DIR__ . '/../../resources/opengl.win32.h',
            'Linux' => __DIR__ . '/../../resources/opengl.linux.h',
        };
    }

    /**
     * @return non-empty-string
     */
    private function getBinary(): string
    {
        $location = match(PHP_OS_FAMILY) {
            'Windows' => ['opengl32.dll'],
            'Linux' => ['libGL.so.1', 'libGL.so'],
            default => throw new \LogicException('Unsupported OS'),
        };

        return Locator::resolve(...$location)
            ?? throw new \LogicException(\sprintf(
                'Could not resolve binary pathname(%s)',
                \implode(', ', $location),
            ));
    }

    /**
     * @param non-empty-string $method
     * @param array $args
     * @return mixed
     */
    public function __call(string $method, array $args): mixed
    {
        $proc = $this->getProc($method);

        return $proc(...$args);
    }

    /**
     * @param non-empty-string $name
     * @return callable
     */
    public function getProc(string $name): callable
    {
        /** @var array<non-empty-string, callable> $memory */
        static $memory = [];

        try {
            return $memory[$name] ??= $this->ffi->cast(
                'PFN' . \strtoupper($name) . 'PROC',
                $this->getProcAddress($name)
            );
        } catch(ParserException) {
            throw new \BadMethodCallException('Could not load OpenGL proc function [' . $name . ']');
        }
    }

    /**
     * @param non-empty-string $name
     * @return CData
     */
    public function getProcAddress(string $name): CData
    {
        $proc = match(PHP_OS_FAMILY) {
            'Windows' => $this->ffi->wglGetProcAddress($name),
            'Linux' => $this->glXGetProcAddress($name),
            default => throw new \LogicException('Unsupported OS'),
        };

        if($proc === null) {
            throw new \BadMethodCallException('Could not OpenGL load proc function [' . $name . ']');
        }

        return $proc;
    }

    /**
     * @param string $name
     * @return CData|null
     */
    public function glXGetProcAddress(string $name): ?CData
    {
        $length = strlen($name) + 1;

        $string = \FFI::cast("uint8_t[$length]", Type::string($name));

        return $this->ffi->glXGetProcAddress(\FFI::addr($string[0]));
    }

    /**
     * @param non-empty-string $name
     * @return callable
     */
    public function __get(string $name): callable
    {
        return $this->getProc($name);
    }

    public function glCullFace(int $mode): void
    {
        $this->ffi->glCullFace($mode);
    }

    public function glFrontFace(int $mode): void
    {
        $this->ffi->glFrontFace($mode);
    }

    public function glHint(int $target, int $mode): void
    {
        $this->ffi->glHint($target, $mode);
    }

    public function glLineWidth(float $width): void
    {
        $this->ffi->glLineWidth($width);
    }

    public function glPointSize(float $size): void
    {
        $this->ffi->glPointSize($size);
    }

    public function glPolygonMode(int $face, int $mode): void
    {
        $this->ffi->glPolygonMode($face, $mode);
    }

    public function glScissor(float $x, float $y, int $width, int $height): void
    {
        $this->ffi->glScissor($x, $y, $width, $height);
    }

    public function glTexParameterf(int $target, int $pname, float $param): void
    {
        $this->ffi->glTexParameterf($target, $pname, $param);
    }

    public function glTexParameterfv(int $target, int $pname, CData $params): void
    {
        $this->ffi->glTexParameterfv($target, $pname, $params);
    }

    public function glTexParameteri(int $target, int $pname, float $param): void
    {
        $this->ffi->glTexParameteri($target, $pname, $param);
    }

    public function glTexParameteriv(int $target, int $pname, CData $params): void
    {
        $this->ffi->glTexParameteriv($target, $pname, $params);
    }

    public function glTexImage1D(
        int $target,
        float $level,
        float $internalformat,
        int $width,
        float $border,
        int $format,
        int $type,
        CData $pixels
    ): void {
        $this->ffi->glTexImage1D($target, $level, $internalformat, $width, $border, $format, $type, $pixels);
    }

    public function glTexImage2D(
        int $target,
        float $level,
        float $internalformat,
        int $width,
        int $height,
        float $border,
        int $format,
        int $type,
        CData $pixels
    ): void {
        $this->ffi->glTexImage2D($target, $level, $internalformat, $width, $height, $border, $format, $type, $pixels);
    }

    public function glDrawBuffer(int $buf): void
    {
        $this->ffi->glDrawBuffer($buf);
    }

    public function glClear(int $mask): void
    {
        $this->ffi->glClear($mask);
    }

    public function glClearColor(float $red, float $green, float $blue, float $alpha): void
    {
        $this->ffi->glClearColor($red, $green, $blue, $alpha);
    }

    public function glClearStencil(float $s): void
    {
        $this->ffi->glClearStencil($s);
    }

    public function glClearDepth(float $depth): void
    {
        $this->ffi->glClearDepth($depth);
    }

    public function glStencilMask(int $mask): void
    {
        $this->ffi->glStencilMask($mask);
    }

    public function glColorMask(int $red, int $green, int $blue, int $alpha): void
    {
        $this->ffi->glColorMask($red, $green, $blue, $alpha);
    }

    public function glDepthMask(int $flag): void
    {
        $this->ffi->glDepthMask($flag);
    }

    public function glDisable(int $cap): void
    {
        $this->ffi->glDisable($cap);
    }

    public function glEnable(int $cap): void
    {
        $this->ffi->glEnable($cap);
    }

    public function glFinish(): void
    {
        $this->ffi->glFinish();
    }

    public function glFlush(): void
    {
        $this->ffi->glFlush();
    }

    public function glBlendFunc(int $sfactor, int $dfactor): void
    {
        $this->ffi->glBlendFunc($sfactor, $dfactor);
    }

    public function glLogicOp(int $opcode): void
    {
        $this->ffi->glLogicOp($opcode);
    }

    public function glStencilFunc(int $func, float $ref, int $mask): void
    {
        $this->ffi->glStencilFunc($func, $ref, $mask);
    }

    public function glStencilOp(int $fail, int $zfail, int $zpass): void
    {
        $this->ffi->glStencilOp($fail, $zfail, $zpass);
    }

    public function glDepthFunc(int $func): void
    {
        $this->ffi->glDepthFunc($func);
    }

    public function glPixelStoref(int $pname, float $param): void
    {
        $this->ffi->glPixelStoref($pname, $param);
    }

    public function glPixelStorei(int $pname, float $param): void
    {
        $this->ffi->glPixelStorei($pname, $param);
    }

    public function glReadBuffer(int $src): void
    {
        $this->ffi->glReadBuffer($src);
    }

    public function glReadPixels(
        float $x,
        float $y,
        int $width,
        int $height,
        int $format,
        int $type,
        CData $pixels
    ): void {
        $this->ffi->glReadPixels($x, $y, $width, $height, $format, $type, $pixels);
    }

    public function glGetBooleanv(int $pname, CData $data): void
    {
        $this->ffi->glGetBooleanv($pname, $data);
    }

    public function glGetDoublev(int $pname, CData $data): void
    {
        $this->ffi->glGetDoublev($pname, ta);
    }

    public function glGetFloatv(int $pname, CData $data): void
    {
        $this->ffi->glGetFloatv($pname, $data);
    }

    public function glGetIntegerv(int $pname, CData $data): void
    {
        $this->ffi->glGetIntegerv($pname, $data);
    }

    public function glGetTexImage(int $target, float $level, int $format, int $type, CData $pixels): void
    {
        $this->ffi->glGetTexImage($target, $level, $format, $type, $pixels);
    }

    public function glGetTexParameterfv(int $target, int $pname, CData $params): void
    {
        $this->ffi->glGetTexParameterfv($target, $pname, $params);
    }

    public function glGetTexParameteriv(int $target, int $pname, CData $params): void
    {
        $this->ffi->glGetTexParameteriv($target, $pname, $params);
    }

    public function glGetTexLevelParameterfv(int $target, float $level, int $pname, CData $params): void
    {
        $this->ffi->glGetTexLevelParameterfv($target, $level, $pname, $params);
    }

    public function glGetTexLevelParameteriv(int $target, float $level, int $pname, CData $params): void
    {
        $this->ffi->glGetTexLevelParameteriv($target, $level, $pname, $params);
    }

    public function glDepthRange(float $n, float $f): void
    {
        $this->ffi->glDepthRange($n, $f);
    }

    public function glViewport(float $x, float $y, int $width, int $height): void
    {
        $this->ffi->glViewport($x, $y, $width, $height);
    }

    public function glIsEnabled(int $cap): int
    {
        return $this->ffi->glIsEnabled($cap);
    }

    public function glGetError(): int
    {
        return $this->ffi->glGetError();
    }

    public function glGetString(int $name): string
    {
        $result = $this->ffi->glGetString($name);

        if($result === null) {
            return '';
        }

        return Type::toString($this->ffi->glGetString($name));
    }
    
    public function glDrawArrays(int $mode, int $first, int $count): void
    {
        $this->ffi->glDrawArrays($mode, $first, $count);
    }

    public function glDrawElements(int $mode, int $count, int $type, CData|null $indices): void
    {
        $this->ffi->glDrawElements($mode, $count, $type, $indices);
    }

    public function glGetPointerv(int $pname, CData $params): void
    {
        $this->ffi->glGetPointerv($pname, $params);
    }

    public function glPolygonOffset(float $factor, float $units): void
    {
        $this->ffi->glPolygonOffset($factor, $units);
    }

    public function glCopyTexImage1D(int $target, int $level, int $internalformat, int $x, int $y, int $width, int $border): void
    {
        $this->ffi->glCopyTexImage1D($target, $level, $internalformat, $x, $y, $width, $border);
    }

    public function glCopyTexImage2D(int $target, int $level, int $internalformat, int $x, int $y, int $width, int $height, int $border): void
    {
        $this->ffi->glCopyTexImage2D($target, $level, $internalformat, $x, $y, $width, $height, $border);
    }

    public function glCopyTexSubImage1D(int $target, int $level, int $xoffset, int $x, int $y, int $width): void
    {
        $this->ffi->glCopyTexSubImage1D($target, $level, $xoffset, $x, $y, $width);
    }

    public function glCopyTexSubImage2D(int $target, int $level, int $xoffset, int $yoffset, int $x, int $y, int $width, int $height): void
    {
        $this->ffi->glCopyTexSubImage2D($target, $level, $xoffset, $yoffset, $x, $y, $width, $height);
    }

    public function glTexSubImage1D(int $target, int $level, int $xoffset, int $width, int $format, int $type, CData $pixels): void
    {
        $this->ffi->glTexSubImage1D($target, $level, $xoffset, $width, $format, $type, $pixels);
    }

    public function glTexSubImage2D(int $target, int $level, int $xoffset, int $yoffset, int $width, int $height, int $format, int $type, CData $pixels): void
    {
        $this->ffi->glTexSubImage2D($target, $level, $xoffset, $yoffset, $width, $height, $format, $type, $pixels);
    }

    public function glBindTexture(int $target, int $texture): void
    {
        $this->ffi->glBindTexture($target, $texture);
    }

    public function glDeleteTextures(int $n, CData $textures): void
    {
        $this->ffi->glDeleteTextures($n, $textures);
    }

    public function glGenTextures(int $n, CData $textures): void
    {
        $this->ffi->glGenTextures($n, $textures);
    }

    public function glIsTexture(int $texture): int
    {
        return $this->ffi->glIsTexture($texture);
    }
}
