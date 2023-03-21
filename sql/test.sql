.header on
select *,sum(time) from data where date = "2023-03-19" order by title desc, id desc;
