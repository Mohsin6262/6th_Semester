
# PlanAhead Launch Script for Pre-Synthesis Floorplanning, created by Project Navigator

create_project -name lab05 -dir "D:/Semester Data/6th semester/DSD LAB/lab03/lab05/planAhead_run_2" -part xc6slx9csg324-2
set_param project.pinAheadLayout yes
set srcset [get_property srcset [current_run -impl]]
set_property target_constrs_file "BCDa.ucf" [current_fileset -constrset]
set hdlfile [add_files [list {task01.v}]]
set_property file_type Verilog $hdlfile
set_property library work $hdlfile
set_property top task2 $srcset
add_files [list {BCDa.ucf}] -fileset [get_property constrset [current_run]]
open_rtl_design -part xc6slx9csg324-2
