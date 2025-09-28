
# PlanAhead Launch Script for Pre-Synthesis Floorplanning, created by Project Navigator

create_project -name BCD -dir "D:/Semester Data/6th semester/DSD LAB/lab03/BCD/planAhead_run_1" -part xc6slx9csg324-2
set_param project.pinAheadLayout yes
set srcset [get_property srcset [current_run -impl]]
set_property target_constrs_file "tasks.ucf" [current_fileset -constrset]
set hdlfile [add_files [list {BCD.v}]]
set_property file_type Verilog $hdlfile
set_property library work $hdlfile
set_property top tasks $srcset
add_files [list {tasks.ucf}] -fileset [get_property constrset [current_run]]
open_rtl_design -part xc6slx9csg324-2
