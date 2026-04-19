## Traslation functions

### use case and meaning

```

- __ only return
- _e will echo
- _x -> if a word have 2 meaning your can specify the actual meaning

```

### With escaping

```

- esc_html__("" ,  "")      // return the valud
- esc_html_e("" ,  "")      // echo the value
- esc_html_x("" ,  "", "")
- esc_attr__("" ,  "")
- esc_attr_e("" ,  "")
- esc_attr_x("" ,  "", "")
```

### without escaping

```
-- With escaping
__("" ,  "")
_e("" ,  "")
_x("" ,  "", "")
__("" ,  "")
_e("" ,  "")
_x("" ,  "", "")

```
