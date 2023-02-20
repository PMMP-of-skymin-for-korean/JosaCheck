# JosaCheck
조사를 자동으로 정해보세요

문장 조사 선택에서 더 원하시는 조사가 있다면 이슈를 남겨주세요

# 사용법
## 받힘 있는지 확인하기
마지막 글자에 받힘이 있는지 확인합니다.
```php
JosaCheck::hasJongsung(string $str) : bool
```

## 조사선택
마지막 글자에 받힘이 있는지 확인하고 조사를 선택해 줍니다.
```php
JosaCheck::selectJosa(string $word, string $has_jongsung, string $no_jongsung) : string
```

## 문장 조사 선택
문장을 읽고 맞는 조사들로 선택해준다.
```php
JosaCheck::replaceJosa(string $str);
```

### 예시
```php
echo JosaCheck::replaceJosa('스티브(은/는) 금(과/와) 사과(으로/로) 황금사과(을/를) 만들었다');
```
```console
스티브는 금과 사과로 황금사과를 만들었다
```
