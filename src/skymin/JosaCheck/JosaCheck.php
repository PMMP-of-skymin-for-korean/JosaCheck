<?php

declare(strict_types=1);

namespace skymin\JosaCheck;

use function explode;
use function mb_ord;
use function mb_substr;
use function preg_replace_callback;
use function str_replace;

final class JosaCheck{

	//한글음절 시작
	private const START = 0xAC00;

	public static function hasJongsung(string $str) : bool{
		$code = mb_ord(mb_substr($str, -1, 1));
		return ($code - self::START) % 28 !== 0;
	}

	/**
	 * @param string $word         단어
	 * @param string $has_jongsung 마지막 단어에 받힘이 있을 경우 붙혀줄 조사
	 * @param string $no_jongsung  마지막 단어에 받힘이 없을 경우 붙혀줄 조사
	 *
	 * @return string              선택된 조사
	 */
	public static function selectJosa(string $word, string $has_jongsung, string $no_jongsung) : string{
		return self::hasJongsung($word) ? $has_jongsung : $no_jongsung;
	}

	/** @example JosaCheck::replaceJosa('사과(과/와) 바나나') -> 사과와 바나나 */
	public static function replaceJosa(string $str) : string{
		return preg_replace_callback(
			'/([가-힣])(\(은\/는\)|\(이\/가\)|\(을\/를\)|\(과\/와\)|\(아\/야\)|\(이여\/여\)|\(이랑\/랑\)|\(으로\/로\))/ux',
			static function (array $matches) : string{
				$josaSelector = explode('/', str_replace(['(', ')'], '', $matches[2]));
				return $matches[1] . self::selectJosa($matches[1], $josaSelector[0], $josaSelector[1]);
			}, $str
		);
	}
}
